<?php include("connection.php"); include("functions.php"); extract($_REQUEST);

$url="filter=yes"; $qry=""; $filters="";

		//Price
		if(isset($price_min) && isset($price_max) && $price_min!=0 && $price_max!=25){
			$url.="%2Cprice-between-".$price_min."-lacs-to-".$price_max."-lacs";
			$qry.=" and selling_price between ".($price_min*100000)." and ".($price_max*100000);
			$filters.='<li class="applied-filters__item" onclick="clearfilter(\'fullprice\');"><span class="applied-filters__button applied-filters__button--filter">Price between '.$price_min.'lacs - '.$price_max.' lacs <i class="fa fa-ban"></i></li>';

		} else if(isset($price_min) || isset($price_max)){ 

			if(isset($price_min) && $price_min!=0){
				$url.="%2Cprice-min-".$price_min."-lacs";
				$qry.=" and selling_price >=".($price_min*100000);
				$filters.='<li class="applied-filters__item" onclick="clearfilter(\'minprice\');"><span class="applied-filters__button applied-filters__button--filter">Price Minimum '.$price_min.'lacs <i class="fa fa-ban"></i></li>';
			}
			if(isset($price_max) && $price_max!=25){
				$url.="%2Cprice-max-".$price_max."-lacs";
				$qry.=" and selling_price <=".($price_max*100000);
				$filters.='<li class="applied-filters__item" onclick="clearfilter(\'maxprice\');"><span class="applied-filters__button applied-filters__button--filter">Price Maximum '.$price_max.' lacs <i class="fa fa-ban"></i></li>';
			}
		}

		// Maker
		if(isset($maker)) {
			$url.="%2Cmaker-".implode("_",$maker);
			$qry.=" and maker in(".implode(",",$maker).")";
		}

		// Model
		if(isset($model)) {
			$url.="%2Cmodel-".implode("_",$model);
			$qry.=" and model in(".implode(",",$model).")";
			$models=$objMain->getResults("select * from model where id in (".implode(",", $model).")");
			foreach($models as $mod){
				$filters.='<li class="applied-filters__item" onclick="clearfilter(\'model\','.$mod['id'].');"><span class="applied-filters__button applied-filters__button--filter"> '.ucfirst($mod['search_word']).' <i class="fa fa-ban"></i></li>';
			}
		}

		// Fuel
		if(isset($fuel)){
			$url.="%2Cfuel-".implode("_",$fuel);
			$qry.=" and fuel in('".implode("','",$fuel)."')";
			foreach($fuel as $fue){
				$filters.='<li class="applied-filters__item" onclick="clearfilter(\'fuel\',\''.$fue.'\');"><span class="applied-filters__button applied-filters__button--filter"> '.ucfirst($fue).' <i class="fa fa-ban"></i></li>';
			}
		}

		// Body style
		if(isset($body)){
			$url.="%2Cbody-".implode("_",$body);
			$qry.=" and vehicle_type in(".implode(",",$body).")";
			$bodys=$objMain->getResults("select * from car_type where id in (".implode(",", $body).")");
			foreach($bodys as $bod){
				$filters.='<li class="applied-filters__item" onclick="clearfilter(\'body\','.$bod['id'].');"><span class="applied-filters__button applied-filters__button--filter"> '.ucfirst($bod['type_name']).' <i class="fa fa-ban"></i></li>';
			}
		}

		// Transmission
		if(isset($transmission)){
			$url.="%2Cgear-".implode("_",$transmission);
			$qry.=" and gear in('".implode("','",$transmission)."')";
			foreach($transmission as $trans){
				$filters.='<li class="applied-filters__item" onclick="clearfilter(\'gear\',\''.$trans.'\');"><span class="applied-filters__button applied-filters__button--filter"> '.ucfirst($trans).' <i class="fa fa-ban"></i></li>';
			}
		}

		// KM
		if(isset($km)){
			$url.="%2Ckm-".$km;
			if($km!=0 && $km!=200000) {
			$qry.=" and km<= '".$km."'";
		$filters.='<li class="applied-filters__item" onclick="clearfilter(\'km\');"><span class="applied-filters__button applied-filters__button--filter">KM upto '.$km.' <i class="fa fa-ban"></i></li>';
	}
		}

		// Model Year/*
	/*	if(isset($model_year)){
			$url.="%2Cyear-".$model_year;
			if($model_year!=1970) {
			$qry.=" and model_year>= ".$model_year." ";
			$filters.='<li class="applied-filters__item" onclick="clearfilter(\'year\');"><span class="applied-filters__button applied-filters__button--filter">Year Minimum '.$model_year.' lacs <i class="fa fa-ban"></i></li>';
			}
		} */

		if(isset($year_min) && isset($year_max)){
			$url.="%2Cyear-between-".$year_min."-to-".$year_max;
			$qry.=" and model_year between ".($year_min)." and ".($year_max);
			$filters.='<li class="applied-filters__item" onclick="clearfilter(\'year\');"><span class="applied-filters__button applied-filters__button--filter">Year between '.$year_min.' - '.$year_max.' <i class="fa fa-ban"></i></li>';

		}


		if($filters!="") $filters.='<li class="applied-filters__item" onclick="clearfilter(\'reset\');"><button type="button" class="applied-filters__button applied-filters__button--clear">Clear All</button></li>';

		if($sort=='latest') $qry.=" order by posted_date desc";
		else if($sort=='price-low-high') $qry.=" order by selling_price asc";
		else if($sort=='price-high-low') $qry.=" order by selling_price desc";
		else if($sort=='km-low-high') $qry.=" order by km asc";
		else if($sort=='year-high-low') $qry.=" order by model_year desc";

if($page==0) {
	$cnt=$objMain->getResultsCount("select id from car where status='available' ".$qry);
	$_SESSION['results_count']=$cnt." Cars Found";
}

							$results=$objMain->getResults("select * from car where status='available'  ".$qry." limit ".($page*10).",10");
$data=""; $i=0;
							if(!empty($results)){ $i=1;
								foreach($results as $result){  $rs=rand(0,1); 

									if(isset($_SESSION['userid'])) $contact_seller='<button onclick="addchat('.$result['id'].');" class="product-card__addtocart-full contactbtn" type="button">Contact Seller</button>';
									else $contact_seller='<a href="car-details.php?id='.$result['id'].'" class="product-card__addtocart-full contactbtn" type="button">Contact Seller</a>';
									
									if($result['image_path']!="" && file_exists(DIR_CAR.$result['image_path'])) $cover_image=HTTP_CAR.$result['image_path'];
        else $cover_image=HTTP_CAR."noimage.jpg";

								$features="";
								
								if($result['gear']=='manual') $features.="<li>Gear: Manual</li>";
								else if($result['gear']=='automatic') $features.="<li>Gear: automatic</li>";

								$rto=$objMain->getRow("select * from rto where id=".$result['regno_code1']);

								if($result['regno_code1']!='') $features.="<li>RTO: ".$rto['type_name']."</li>";

								if($result['owner_type']!=0) $features.="<li>Ownership: ".$result['owner_type']." owner</li>";

								if($result['vehicle_type']!=0) {
									$body=$objMain->getRow("select * from car_type where id=".$result['vehicle_type']);
									$features.="<li>Body Type: ".$body['type_name']."</li>";
								} 

								if($result['insurance_type']!="") { $expire="";
									if($result['insurance_expire']!='1970-01-01' && $result['insurance_expire']!='0000-00-00')
										$expire=" Expire at ".date("d-m-Y",strtotime($result['insurance_expire']));
									$features.="<li>Insurance: ".ucfirst($result['insurance_type']).$expire."</li>";
								} 

								if($result['board']!="")  {
									if($result['board']=='own')
									$features.="<li>Board: Own Board</li>";
									else 
									$features.="<li>Board: T Board</li>";
								}

                            $data.='
                            <div class="products-list__item">
                                                <div class="product-card">
                                                    
                                                    <div class="product-card__image">
                                                        <a href="car-details.php?id='.$result['id'].'"><img src="'.$cover_image.'" alt=""></a>
                                                        <div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
                                                            
                                                                
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="product-card__info">
                                                        
                                                        <div class="product-card__name">
                                                            <div>
                                                                <div class="product-card__badges">
                                                                </div><a href="car-details.php?id='.$result['id'].'">'.$objMain->BMV($result['maker'],$result['model'],$result['varient']).'</a></div>
                                                        </div>
                                                        <div class="product-card__rating">
                                                            <div class="rating product-card__rating-stars">
                                                                '.$result['model_year'].' | '.$result['km'].' KM | '.$result['fuel'].'
                                                            </div>
                                                        </div>
                                                        <div class="product-card__features">
                                                            <ul>
                                                                '.$features.'
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-card__footer">
                                                        <div class="product-card__prices">
                                                            <div class="product-card__price product-card__price--current">Rs. '.$objMain->INR($result['selling_price']).'</div>
                                                        </div>
                                                        '.$contact_seller.'
                                                    </div>
                                                </div>
                                            </div>
                                ';
                             } } 

$data = array("data" => $data, 'url' => $url, 'qry' => "select * from car where 1=1 ".$qry." limit ".($page*10).",10", 'results_count' => $_SESSION['results_count'],'filters' => $filters , "more" => $i );
$json = json_encode($data);
echo $json;
?>