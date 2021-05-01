/*!
 * MotionPathPlugin 3.2.3
 * https://greensock.com
 * 
 * @license Copyright 2020, GreenSock. All rights reserved.
 * Subject to the terms at https://greensock.com/standard-license or for Club GreenSock members, the agreement issued with that membership.
 * @author: Jack Doyle, jack@greensock.com
 */

!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?e(exports):"function"==typeof define&&define.amd?define(["exports"],e):e((t=t||self).window=t.window||{})}(this,function(t){"use strict";function p(t){return"string"==typeof t}function x(t,e,n,r){var a=t[e],i=1===r?6:subdivideSegment(a,n,r);if(i&&i+n+2<a.length)return t.splice(e,0,a.slice(0,n+i+2)),a.splice(0,n+i),1}function A(t,e){var n=t.length,r=t[n-1]||[],a=r.length;e[0]===r[a-2]&&e[1]===r[a-1]&&(e=r.concat(e.slice(2)),n--),t[n]=e}var M=/[achlmqstvz]|(-?\d*\.?\d*(?:e[\-+]?\d+)?)[0-9]/gi,S=/(?:(-)?\d*\.?\d*(?:e[\-+]?\d+)?)[0-9]/gi,R=/[\+\-]?\d*\.?\d+e[\+\-]?\d+/gi,r=/(^[#\.][a-z]|[a-y][a-z])/i,F=Math.PI/180,s=180/Math.PI,U=Math.sin,H=Math.cos,Z=Math.abs,Q=Math.sqrt,L=Math.atan2,B=1e8,l=function _isNumber(t){return"number"==typeof t},N={},_={},e=1e5,d=function _wrapProgress(t){return Math.round((t+B)%1*e)/e||(t<0?0:1)},C=function _round(t){return Math.round(t*e)/e||0},D=function _copyMetaData(t,e){return e.totalLength=t.totalLength,t.samples?(e.samples=t.samples.slice(0),e.lookup=t.lookup.slice(0),e.minLength=t.minLength,e.resolution=t.resolution):e.totalPoints=t.totalPoints,e};function getRawPath(t){var e,n=(t=p(t)&&r.test(t)&&document.querySelector(t)||t).getAttribute?t:0;return n&&(t=t.getAttribute("d"))?(n._gsPath||(n._gsPath={}),(e=n._gsPath[t])&&!e._dirty?e:n._gsPath[t]=stringToRawPath(t)):t?p(t)?stringToRawPath(t):l(t[0])?[t]:t:console.warn("Expecting a <path> element or an SVG path data string")}function reverseSegment(t){var e,n=0;for(t.reverse();n<t.length;n+=2)e=t[n],t[n]=t[n+1],t[n+1]=e;t.reversed=!t.reversed}var z={rect:"rx,ry,x,y,width,height",circle:"r,cx,cy",ellipse:"rx,ry,cx,cy",line:"x1,x2,y1,y2"};function convertToPath(t,e){var n,r,a,i,o,s,l,h,u,g,f,p,c,d,m,v,x,y,P,w,b,M,R=t.tagName.toLowerCase(),L=.552284749831;return"path"!==R&&t.getBBox?(s=function _createPath(t,e){var n,r=document.createElementNS("http://www.w3.org/2000/svg","path"),a=[].slice.call(t.attributes),i=a.length;for(e=","+e+",";-1<--i;)n=a[i].nodeName.toLowerCase(),e.indexOf(","+n+",")<0&&r.setAttributeNS(null,n,a[i].nodeValue);return r}(t,"x,y,width,height,cx,cy,rx,ry,r,x1,x2,y1,y2,points"),M=function _attrToObj(t,e){for(var n=e?e.split(","):[],r={},a=n.length;-1<--a;)r[n[a]]=+t.getAttribute(n[a])||0;return r}(t,z[R]),"rect"===R?(i=M.rx,o=M.ry,r=M.x,a=M.y,g=M.width-2*i,f=M.height-2*o,n=i||o?"M"+(v=(d=(c=r+i)+g)+i)+","+(y=a+o)+" V"+(P=y+f)+" C"+[v,w=P+o*L,m=d+i*L,b=P+o,d,b,d-(d-c)/3,b,c+(d-c)/3,b,c,b,p=r+i*(1-L),b,r,w,r,P,r,P-(P-y)/3,r,y+(P-y)/3,r,y,r,x=a+o*(1-L),p,a,c,a,c+(d-c)/3,a,d-(d-c)/3,a,d,a,m,a,v,x,v,y].join(",")+"z":"M"+(r+g)+","+a+" v"+f+" h"+-g+" v"+-f+" h"+g+"z"):"circle"===R||"ellipse"===R?(h="circle"===R?(i=o=M.r)*L:(i=M.rx,(o=M.ry)*L),n="M"+((r=M.cx)+i)+","+(a=M.cy)+" C"+[r+i,a+h,r+(l=i*L),a+o,r,a+o,r-l,a+o,r-i,a+h,r-i,a,r-i,a-h,r-l,a-o,r,a-o,r+l,a-o,r+i,a-h,r+i,a].join(",")+"z"):"line"===R?n="M"+M.x1+","+M.y1+" L"+M.x2+","+M.y2:"polyline"!==R&&"polygon"!==R||(n="M"+(r=(u=(t.getAttribute("points")+"").match(S)||[]).shift())+","+(a=u.shift())+" L"+u.join(","),"polygon"===R&&(n+=","+r+","+a+"z")),s.setAttribute("d",rawPathToString(s._gsRawPath=stringToRawPath(n))),e&&t.parentNode&&(t.parentNode.insertBefore(s,t),t.parentNode.removeChild(t)),s):t}function getRotationAtBezierT(t,e,n){var r,a=t[e],i=t[e+2],o=t[e+4];return a+=(i-a)*n,a+=((i+=(o-i)*n)-a)*n,r=i+(o+(t[e+6]-o)*n-i)*n-a,a=t[e+1],a+=((i=t[e+3])-a)*n,a+=((i+=((o=t[e+5])-i)*n)-a)*n,C(L(i+(o+(t[e+7]-o)*n-i)*n-a,r)*s)}function sliceRawPath(t,e,n){!function _isUndefined(t){return void 0===t}(n)||(n=1);var r=n<(e=e||0),a=Math.max(0,~~(Z(n-e)-1e-8));if(r&&(r=n,n=e,e=r,r=1,a-=a?1:0),e<0||n<0){var i=1+~~Math.min(e,n);e+=i,n+=i}var o,s,l,h,u,g,f,p=function copyRawPath(t){for(var e=[],n=0;n<t.length;n++)e[n]=D(t[n],t[n].slice(0));return D(t,e)}(t.totalLength?t:cacheRawPathMeasurements(t)),c=1<n,d=getProgressData(p,e,N,!0),m=getProgressData(p,n,_),v=m.segment,y=d.segment,P=m.segIndex,w=d.segIndex,b=m.i,M=d.i,R=w===P,L=b===M&&R,T=R&&b<M||L&&d.t>m.t;if(c||a){if(x(p,w,M,d.t)&&(o=1,w++,L?T?m.t/=d.t:(m.t=(m.t-d.t)/(1-d.t),P++,b=0):w<=P+1&&!T&&(P++,R&&(b-=M))),m.t?x(p,P,b,m.t)&&(T&&o&&w++,r&&P++):(P--,r&&w--),h=[],g=1+(u=p.length)*a,f=w,r)for(g+=(u-(P=(P||u)-1)+w)%u,l=0;l<g;l++)A(h,p[f]),f=(f||u)-1;else for(g+=(u-w+P)%u,l=0;l<g;l++)A(h,p[f++%u]);p=h}else if(s=1===m.t?6:subdivideSegment(v,b,m.t),e!==n)for(o=subdivideSegment(y,M,L?d.t/m.t:d.t),R&&(s+=o),v.splice(b+s+2),(o||M)&&y.splice(0,M+o),l=p.length;l--;)(l<w||P<l)&&p.splice(l,1);else v.angle=getRotationAtBezierT(v,b+s,0),d=v[b+=s],m=v[b+1],v.length=v.totalLength=0,v.totalPoints=p.totalPoints=8,v.push(d,m,d,m,d,m,d,m);return r&&function _reverseRawPath(t,e){var n=t.length;for(e||t.reverse();n--;)t[n].reversed||reverseSegment(t[n])}(p,c||a),p.totalLength=0,p}function measureSegment(t,e,n){e=e||0,t.samples||(t.samples=[],t.lookup=[]);var r,a,i,o,s,l,h,u,g,f,p,c,d,m,v,x,y,P=~~t.resolution||12,w=1/P,b=n?e+6*n+1:t.length,M=t[e],R=t[e+1],L=e?e/6*P:0,T=t.samples,S=t.lookup,N=(e?t.minLength:B)||B,_=T[L+n*P-1],C=e?T[L-1]:0;for(T.length=S.length=0,a=e+2;a<b;a+=6){if(i=t[a+4]-M,o=t[a+2]-M,s=t[a]-M,u=t[a+5]-R,g=t[a+3]-R,f=t[a+1]-R,l=h=p=c=0,Z(i)<1e-5&&Z(u)<1e-5&&Z(s)+Z(f)<1e-5)8<t.length&&(t.splice(a,6),a-=6,b-=6);else for(r=1;r<=P;r++)l=h-(h=((m=w*r)*m*i+3*(d=1-m)*(m*o+d*s))*m),p=c-(c=(m*m*u+3*d*(m*g+d*f))*m),(x=Q(p*p+l*l))<N&&(N=x),C+=x,T[L++]=C;M+=i,R+=u}if(_)for(_-=C;L<T.length;L++)T[L]+=_;if(T.length&&N)for(t.totalLength=y=T[T.length-1]||0,t.minLength=N,x=v=0,r=0;r<y;r+=N)S[x++]=T[v]<r?++v:v;else t.totalLength=T[0]=0;return e?C-T[e/2-1]:C}function cacheRawPathMeasurements(t,e){var n,r,a;for(a=n=r=0;a<t.length;a++)t[a].resolution=~~e||12,r+=t[a].length,n+=measureSegment(t[a]);return t.totalPoints=r,t.totalLength=n,t}function subdivideSegment(t,e,n){if(n<=0||1<=n)return 0;var r=t[e],a=t[e+1],i=t[e+2],o=t[e+3],s=t[e+4],l=t[e+5],h=r+(i-r)*n,u=i+(s-i)*n,g=a+(o-a)*n,f=o+(l-o)*n,p=h+(u-h)*n,c=g+(f-g)*n,d=s+(t[e+6]-s)*n,m=l+(t[e+7]-l)*n;return u+=(d-u)*n,f+=(m-f)*n,t.splice(e+2,4,C(h),C(g),C(p),C(c),C(p+(u-p)*n),C(c+(f-c)*n),C(u),C(f),C(d),C(m)),t.samples&&t.samples.splice(e/6*t.resolution|0,0,0,0,0,0,0,0),6}function getProgressData(t,e,n,r){n=n||{},t.totalLength||cacheRawPathMeasurements(t),(e<0||1<e)&&(e=d(e));var a,i,o,s,l,h,u,g=0,f=t[0];if(1<t.length){for(o=t.totalLength*e,l=h=0;(l+=t[h++].totalLength)<o;)g=h;e=(o-(s=l-(f=t[g]).totalLength))/(l-s)||0}return a=f.samples,i=f.resolution,o=f.totalLength*e,s=(h=f.lookup[~~(o/f.minLength)]||0)?a[h-1]:0,(l=a[h])<o&&(s=l,l=a[++h]),u=1/i*((o-s)/(l-s)+h%i),h=6*~~(h/i),r&&1===u&&(h+6<f.length?(h+=6,u=0):g+1<t.length&&(h=u=0,f=t[++g])),n.t=u,n.i=h,n.path=t,n.segment=f,n.segIndex=g,n}function getPositionOnPath(t,e,n,r){var a,i,o,s,l,h,u,g,f,p=t[0],c=r||{};if((e<0||1<e)&&(e=d(e)),1<t.length){for(o=t.totalLength*e,l=h=0;(l+=t[h++].totalLength)<o;)p=t[h];e=(o-(s=l-p.totalLength))/(l-s)||0}return a=p.samples,i=p.resolution,o=p.totalLength*e,s=(h=p.lookup[~~(o/p.minLength)]||0)?a[h-1]:0,(l=a[h])<o&&(s=l,l=a[++h]),f=1-(u=1/i*((o-s)/(l-s)+h%i)||0),g=p[h=6*~~(h/i)],c.x=C((u*u*(p[h+6]-g)+3*f*(u*(p[h+4]-g)+f*(p[h+2]-g)))*u+g),c.y=C((u*u*(p[h+7]-(g=p[h+1]))+3*f*(u*(p[h+5]-g)+f*(p[h+3]-g)))*u+g),n&&(c.angle=p.totalLength?getRotationAtBezierT(p,h,1<=u?1-1e-9:u||1e-9):p.angle||0),c}function transformRawPath(t,e,n,r,a,i,o){for(var s,l,h,u,g,f=t.length;-1<--f;)for(l=(s=t[f]).length,h=0;h<l;h+=2)u=s[h],g=s[h+1],s[h]=u*e+g*r+i,s[h+1]=u*n+g*a+o;return t._dirty=1,t}function arcToSegment(t,e,n,r,a,i,o,s,l){if(t!==s||e!==l){n=Z(n),r=Z(r);var h=a%360*F,u=H(h),g=U(h),f=Math.PI,p=2*f,c=(t-s)/2,d=(e-l)/2,m=u*c+g*d,v=-g*c+u*d,x=m*m,y=v*v,P=x/(n*n)+y/(r*r);1<P&&(n=Q(P)*n,r=Q(P)*r);var w=n*n,b=r*r,M=(w*b-w*y-b*x)/(w*y+b*x);M<0&&(M=0);var R=(i===o?-1:1)*Q(M),L=n*v/r*R,T=-r*m/n*R,S=u*L-g*T+(t+s)/2,N=g*L+u*T+(e+l)/2,_=(m-L)/n,C=(v-T)/r,A=(-m-L)/n,O=(-v-T)/r,B=_*_+C*C,V=(C<0?-1:1)*Math.acos(_/Q(B)),D=(_*O-C*A<0?-1:1)*Math.acos((_*A+C*O)/Q(B*(A*A+O*O)));isNaN(D)&&(D=f),!o&&0<D?D-=p:o&&D<0&&(D+=p),V%=p,D%=p;var z,E=Math.ceil(Z(D)/(p/4)),G=[],I=D/E,X=4/3*U(I/2)/(1+H(I/2)),j=u*n,k=g*n,Y=g*-r,q=u*r;for(z=0;z<E;z++)m=H(a=V+z*I),v=U(a),_=H(a+=I),C=U(a),G.push(m-X*v,v+X*m,_+X*C,C-X*_,_,C);for(z=0;z<G.length;z+=2)m=G[z],v=G[z+1],G[z]=m*j+v*Y+S,G[z+1]=m*k+v*q+N;return G[z-2]=s,G[z-1]=l,G}}function stringToRawPath(t){function pf(t,e,n,r){u=(n-t)/3,g=(r-e)/3,s.push(t+u,e+g,n-u,r-g,n,r)}var e,n,r,a,i,o,s,l,h,u,g,f,p,c,d,m=(t+"").replace(R,function(t){var e=+t;return e<1e-4&&-1e-4<e?0:e}).match(M)||[],v=[],x=0,y=0,P=m.length,w=0,b="ERROR: malformed path: "+t;if(!t||!isNaN(m[0])||isNaN(m[1]))return console.log(b),v;for(e=0;e<P;e++)if(p=i,isNaN(m[e])?o=(i=m[e].toUpperCase())!==m[e]:e--,r=+m[e+1],a=+m[e+2],o&&(r+=x,a+=y),e||(l=r,h=a),"M"===i)s&&(s.length<8?--v.length:w+=s.length),x=l=r,y=h=a,s=[r,a],v.push(s),e+=2,i="L";else if("C"===i)o||(x=y=0),(s=s||[0,0]).push(r,a,x+1*m[e+3],y+1*m[e+4],x+=1*m[e+5],y+=1*m[e+6]),e+=6;else if("S"===i)u=x,g=y,"C"!==p&&"S"!==p||(u+=x-s[s.length-4],g+=y-s[s.length-3]),o||(x=y=0),s.push(u,g,r,a,x+=1*m[e+3],y+=1*m[e+4]),e+=4;else if("Q"===i)u=x+2/3*(r-x),g=y+2/3*(a-y),o||(x=y=0),x+=1*m[e+3],y+=1*m[e+4],s.push(u,g,x+2/3*(r-x),y+2/3*(a-y),x,y),e+=4;else if("T"===i)u=x-s[s.length-4],g=y-s[s.length-3],s.push(x+u,y+g,r+2/3*(x+1.5*u-r),a+2/3*(y+1.5*g-a),x=r,y=a),e+=2;else if("H"===i)pf(x,y,x=r,y),e+=1;else if("V"===i)pf(x,y,x,y=r+(o?y-x:0)),e+=1;else if("L"===i||"Z"===i)"Z"===i&&(r=l,a=h,s.closed=!0),("L"===i||.5<Z(x-r)||.5<Z(y-a))&&(pf(x,y,r,a),"L"===i&&(e+=2)),x=r,y=a;else if("A"===i){if(c=m[e+4],d=m[e+5],u=m[e+6],g=m[e+7],n=7,1<c.length&&(c.length<3?(g=u,u=d,n--):(g=d,u=c.substr(2),n-=2),d=c.charAt(1),c=c.charAt(0)),f=arcToSegment(x,y,+m[e+1],+m[e+2],+m[e+3],+c,+d,(o?x:0)+1*u,(o?y:0)+1*g),e+=n,f)for(n=0;n<f.length;n++)s.push(f[n]);x=s[s.length-2],y=s[s.length-1]}else console.log(b);return(e=s.length)<6?(v.pop(),e=0):s[0]===s[e-2]&&s[1]===s[e-1]&&(s.closed=!0),v.totalPoints=w+e,v}function flatPointsToSegment(t,e){void 0===e&&(e=1);for(var n=t[0],r=0,a=[n,r],i=2;i<t.length;i+=2)a.push(n,r,t[i],r=(t[i]-n)*e/2,n=t[i],-r);return a}function pointsToSegment(t,e,n){var r,a,i,o,s,l,h,u,g,f,p,c,d,m,v=t.length-2,x=+t[0],y=+t[1],P=+t[2],w=+t[3],b=[x,y,x,y],M=P-x,R=w-y;for(isNaN(n)&&(n=Math.PI/10),e=e||0===e?+e:1,s=2;s<v;s+=2)r=x,a=y,x=P,y=w,c=(l=M)*l+(u=R)*u,d=(M=(P=+t[s+2])-x)*M+(R=(w=+t[s+3])-y)*R,m=(h=P-r)*h+(g=w-a)*g,p=(i=Math.acos((c+d-m)/Q(4*c*d)))/Math.PI*e,f=Q(c)*p,p*=Q(d),x===r&&y===a||(n<i?(o=L(g,h),b.push(C(x-H(o)*f),C(y-U(o)*f),C(x),C(y),C(x+H(o)*p),C(y+U(o)*p))):(o=L(u,l),b.push(C(x-H(o)*f),C(y-U(o)*f)),o=L(R,M),b.push(C(x),C(y),C(x+H(o)*p),C(y+U(o)*p))));return b.push(C(P),C(w),C(P),C(w)),b}function rawPathToString(t){l(t[0])&&(t=[t]);var e,n,r,a,i="",o=t.length;for(n=0;n<o;n++){for(a=t[n],i+="M"+C(a[0])+","+C(a[1])+" C",e=a.length,r=2;r<e;r++)i+=C(a[r++])+","+C(a[r++])+" "+C(a[r++])+","+C(a[r++])+" "+C(a[r++])+","+C(a[r])+" ";a.closed&&(i+="z")}return i}function O(t){var e=t.ownerDocument||t;!(b in t.style)&&"msTransform"in t.style&&(E=(b="msTransform")+"Origin");for(;e.parentNode&&(e=e.parentNode););if(f=window,P=new j,e){c=(g=e).documentElement,m=e.body;var n=e.createElement("div"),r=e.createElement("div");m.appendChild(n),n.appendChild(r),n.style.position="static",n.style[b]="translate3d(0,0,1px)",w=r.offsetParent!==n,m.removeChild(n)}return e}function T(t){return t.ownerSVGElement||("svg"===(t.tagName+"").toLowerCase()?t:null)}function V(t,e){if(t.parentNode&&(g||O(t))){var n=T(t),r=n?n.getAttribute("xmlns")||"http://www.w3.org/2000/svg":"http://www.w3.org/1999/xhtml",a=n?e?"rect":"g":"div",i=2!==e?0:100,o=3===e?100:0,s="position:absolute;display:block;pointer-events:none;",l=g.createElementNS?g.createElementNS(r.replace(/^https/,"http"),a):g.createElement(a);return e&&(n?(y=y||V(t),l.setAttribute("width",.01),l.setAttribute("height",.01),l.setAttribute("transform","translate("+i+","+o+")"),y.appendChild(l)):(v||((v=V(t)).style.cssText=s),l.style.cssText=s+"width:1px;height:1px;top:"+o+"px;left:"+i+"px",v.appendChild(l))),l}throw"Need document and parent."}function X(t,e,n,r,a,i,o){return t.a=e,t.b=n,t.c=r,t.d=a,t.e=i,t.f=o,t}var g,f,c,m,v,y,P,w,n,b="transform",E=b+"Origin",G=[],I=[],j=((n=Matrix2D.prototype).inverse=function inverse(){var t=this.a,e=this.b,n=this.c,r=this.d,a=this.e,i=this.f,o=t*r-e*n;return X(this,r/o,-e/o,-n/o,t/o,(n*i-r*a)/o,-(t*i-e*a)/o)},n.multiply=function multiply(t){var e=this.a,n=this.b,r=this.c,a=this.d,i=this.e,o=this.f,s=t.a,l=t.c,h=t.b,u=t.d,g=t.e,f=t.f;return X(this,s*e+h*r,s*n+h*a,l*e+u*r,l*n+u*a,i+g*e+f*r,o+g*n+f*a)},n.clone=function clone(){return new Matrix2D(this.a,this.b,this.c,this.d,this.e,this.f)},n.equals=function equals(t){var e=this.a,n=this.b,r=this.c,a=this.d,i=this.e,o=this.f;return e===t.a&&n===t.b&&r===t.c&&a===t.d&&i===t.e&&o===t.f},n.apply=function apply(t,e){void 0===e&&(e={});var n=t.x,r=t.y,a=this.a,i=this.b,o=this.c,s=this.d,l=this.e,h=this.f;return e.x=n*a+r*o+l||0,e.y=n*i+r*s+h||0,e},Matrix2D);function Matrix2D(t,e,n,r,a,i){void 0===t&&(t=1),void 0===e&&(e=0),void 0===n&&(n=0),void 0===r&&(r=1),void 0===a&&(a=0),void 0===i&&(i=0),X(this,t,e,n,r,a,i)}function getGlobalMatrix(t,e,n){if(!t||!t.parentNode||(g||O(t)).documentElement===t)return new j;var r=T(t)?G:I,a=function _placeSiblings(t,e){var n,r,a,i,o,s=T(t),l=t===s,h=s?G:I;if(t===f)return t;if(h.length||h.push(V(t,1),V(t,2),V(t,3)),n=s?y:v,s)a=l?{x:0,y:0}:t.getBBox(),o=(r=t.transform?t.transform.baseVal:{}).numberOfItems?(i=(r=r.consolidate().matrix).a*a.x+r.c*a.y,r.b*a.x+r.d*a.y):(r=P,i=a.x,a.y),e&&"g"===t.tagName.toLowerCase()&&(i=o=0),n.setAttribute("transform","matrix("+r.a+","+r.b+","+r.c+","+r.d+","+(r.e+i)+","+(r.f+o)+")"),(l?s:t.parentNode).appendChild(n);else{if(i=o=0,w)for(r=t.offsetParent,a=t;(a=a&&a.parentNode)&&a!==r&&a.parentNode;)4<(f.getComputedStyle(a)[b]+"").length&&(i=a.offsetLeft,o=a.offsetTop,a=0);(a=n.style).top=t.offsetTop-o+"px",a.left=t.offsetLeft-i+"px",r=f.getComputedStyle(t),a[b]=r[b],a[E]=r[E],a.position="fixed"===r.position?"fixed":"absolute",t.parentNode.appendChild(n)}return n}(t,n),i=r[0].getBoundingClientRect(),o=r[1].getBoundingClientRect(),s=r[2].getBoundingClientRect(),l=a.parentNode,h=function _isFixed(t){return"fixed"===f.getComputedStyle(t).position||((t=t.parentNode)&&1===t.nodeType?_isFixed(t):void 0)}(t),u=new j((o.left-i.left)/100,(o.top-i.top)/100,(s.left-i.left)/100,(s.top-i.top)/100,i.left+(h?0:function _getDocScrollLeft(){return f.pageXOffset||g.scrollLeft||c.scrollLeft||m.scrollLeft||0}()),i.top+(h?0:function _getDocScrollTop(){return f.pageYOffset||g.scrollTop||c.scrollTop||m.scrollTop||0}()));return l.removeChild(a),e?u.inverse():u}function fa(t,e,n,r){for(var a=e.length,i=r,o=0;o<a;o++)t[i]=parseFloat(e[o][n]),i+=2;return t}function ga(t,e,n){return parseFloat(t._gsap.get(t,e,n||"px"))||0}function ha(t){var e,n=t[0],r=t[1];for(e=2;e<t.length;e+=2)n=t[e]+=n,r=t[e+1]+=r}function ia(t,e,n,r,a,i,o){return e="cubic"===o.type?[e]:(e.unshift(ga(n,r,o.unitX),a?ga(n,a,o.unitY):0),o.relative&&ha(e),[(a?pointsToSegment:flatPointsToSegment)(e,o.curviness)]),e=i(tt(e,n,o)),et(t,n,r,e,"x",o.unitX),a&&et(t,n,a,e,"y",o.unitY),cacheRawPathMeasurements(e,o.resolution||(0===o.curviness?20:12))}function ja(t){return t}function la(t,e,n){var r,a,i,o=getGlobalMatrix(t);return"svg"===(t.tagName+"").toLowerCase()?(a=(r=t.viewBox.baseVal).x,i=r.y,r.width||(r={width:+t.getAttribute("width"),height:+t.getAttribute("height")})):(r=e&&t.getBBox&&t.getBBox(),a=i=0),e&&"auto"!==e&&(a+=e.push?e[0]*(r?r.width:t.offsetWidth||0):e.x,i+=e.push?e[1]*(r?r.height:t.offsetHeight||0):e.y),n.apply(a||i?o.apply({x:a,y:i}):{x:o.e,y:o.f})}function ma(t,e,n,r){var a,i=getGlobalMatrix(t.parentNode,!0,!0),o=i.clone().multiply(getGlobalMatrix(e)),s=la(t,n,i),l=la(e,r,i),h=l.x,u=l.y;return o.e=o.f=0,"auto"===r&&e.getTotalLength&&"path"===e.tagName.toLowerCase()&&(a=e.getAttribute("d").match(K)||[],h+=(a=o.apply({x:+a[0],y:+a[1]})).x,u+=a.y),(a||e.getBBox&&t.getBBox)&&(h-=(a=o.apply(e.getBBox())).x,u-=a.y),o.e=h-s.x,o.f=u-s.y,o}var k,Y,q,W,$=["x","translateX","left","marginLeft"],J=["y","translateY","top","marginTop"],i=Math.PI/180,K=/[-+\.]*\d+[\.e\-\+]*\d*[e\-\+]*\d*/g,tt=function _align(t,e,n){var r,a,i,o=n.align,s=n.matrix,l=n.offsetX,h=n.offsetY,u=n.alignOrigin,g=t[0][0],f=t[0][1],p=ga(e,"x"),c=ga(e,"y");return t&&t.length?(o&&("self"===o||(r=W(o)[0]||e)===e?transformRawPath(t,1,0,0,1,p-g,c-f):(u&&!1!==u[2]?k.set(e,{transformOrigin:100*u[0]+"% "+100*u[1]+"%"}):u=[ga(e,"xPercent")/-100,ga(e,"yPercent")/-100],i=(a=ma(e,r,u,"auto")).apply({x:g,y:f}),transformRawPath(t,a.a,a.b,a.c,a.d,p+a.e-(i.x-a.e),c+a.f-(i.y-a.f)))),s?transformRawPath(t,s.a,s.b,s.c,s.d,s.e,s.f):(l||h)&&transformRawPath(t,1,0,0,1,l||0,h||0),t):getRawPath("M0,0L0,0")},et=function _addDimensionalPropTween(t,e,n,r,a,i){var o=e._gsap,s=o.harness,l=s&&s.aliases&&s.aliases[n],h=l&&l.indexOf(",")<0?l:n,u=t._pt=new Y(t._pt,e,h,0,0,ja,0,o.set(e,h,t));u.u=q(o.get(e,h,i))||0,u.path=r,u.pp=a,t._props.push(h)},a={version:"3.2.3",name:"motionPath",register:function register(t,e,n){q=(k=t).utils.getUnit,W=k.utils.toArray,Y=n},init:function init(t,e){if(!k)return console.warn("Please gsap.registerPlugin(MotionPathPlugin)"),!1;"object"==typeof e&&!e.style&&e.path||(e={path:e});var n,r,a,i,o=[],s=e.path,l=s[0],h=e.autoRotate,u=function _sliceModifier(e,n){return function(t){return e||1!==n?sliceRawPath(t,e,n):t}}(e.start,"end"in e?e.end:1);if(this.rawPaths=o,this.target=t,(this.rotate=h||0===h)&&(this.rOffset=parseFloat(h)||0,this.radians=!!e.useRadians,this.rProp=e.rotation||"rotation",this.rSet=t._gsap.set(t,this.rProp,this),this.ru=q(t._gsap.get(t,this.rProp))||0),!Array.isArray(s)||"closed"in s||"number"==typeof l)cacheRawPathMeasurements(n=u(tt(getRawPath(e.path),t,e)),e.resolution),o.push(n),et(this,t,e.x||"x",n,"x",e.unitX||"px"),et(this,t,e.y||"y",n,"y",e.unitY||"px");else{for(r in l)~$.indexOf(r)?a=r:~J.indexOf(r)&&(i=r);for(r in a&&i?o.push(ia(this,fa(fa([],s,a,0),s,i,1),t,e.x||a,e.y||i,u,e)):a=i=0,l)r!==a&&r!==i&&o.push(ia(this,fa([],s,r,0),t,r,0,u,e))}},render:function render(t,e){var n=e.rawPaths,r=n.length,a=e._pt;for(1<t?t=1:t<0&&(t=0);r--;)getPositionOnPath(n[r],t,!r&&e.rotate,n[r]);for(;a;)a.set(a.t,a.p,a.path[a.pp]+a.u,a.d,t),a=a._next;e.rotate&&e.rSet(e.target,e.rProp,n[0].angle*(e.radians?i:1)+e.rOffset+e.ru,e,t)},getLength:function getLength(t){return cacheRawPathMeasurements(getRawPath(t)).totalLength},sliceRawPath:sliceRawPath,getRawPath:getRawPath,pointsToSegment:pointsToSegment,stringToRawPath:stringToRawPath,rawPathToString:rawPathToString,transformRawPath:transformRawPath,getGlobalMatrix:getGlobalMatrix,getPositionOnPath:getPositionOnPath,cacheRawPathMeasurements:cacheRawPathMeasurements,convertToPath:function convertToPath$1(t,e){return W(t).map(function(t){return convertToPath(t,!1!==e)})},convertCoordinates:function convertCoordinates(t,e,n){var r=getGlobalMatrix(e,!0,!0).multiply(getGlobalMatrix(t));return n?r.apply(n):r},getAlignMatrix:ma,getRelativePosition:function getRelativePosition(t,e,n,r){var a=ma(t,e,n,r);return{x:a.e,y:a.f}},arrayToRawPath:function arrayToRawPath(t,e){var n=fa(fa([],t,(e=e||{}).x||"x",0),t,e.y||"y",1);return e.relative&&ha(n),["cubic"===e.type?n:pointsToSegment(n,e.curviness)]}};!function _getGSAP(){return k||"undefined"!=typeof window&&(k=window.gsap)&&k.registerPlugin&&k}()||k.registerPlugin(a),t.MotionPathPlugin=a,t.default=a;if (typeof(window)==="undefined"||window!==t){Object.defineProperty(t,"__esModule",{value:!0})} else {delete t.default}});
