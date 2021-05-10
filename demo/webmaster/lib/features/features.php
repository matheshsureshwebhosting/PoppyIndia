<?php
require_once "lib/functions.php";
global $objFeatures;
class Features extends Main
{

    public function ForgotPassword(){ extract($_REQUEST);
        $cnt=$this->getRow("select * from pu_customers where userid='".$userid."'");
        if(!empty($cnt)){
            $password=rand(100000,999999);
            $this->Query("update pu_customers set userpassword='".$password."' where id=".$cnt['id']);
            $message = "Dear ".$cnt['cname'].", Password been reset. New Password: ".$password.". Login URL: http://www.vettrymp.com/login.php";
            $this->sendsms($cnt['mobileno'],$message);
            header("location:forgot_password.php?msg=suc");
        } else {
            header("location:forgot_password.php?msg=failed");
        }

    }

    

    public function UpdatePage($id){ extract($_REQUEST); 
        $html_code=$this->clean('html_code');
        $sql="update pages set html_code='".$html_code."' where id=".$id;
       
       // die($sql);
        $this->Query($sql);
        header("location:page_update.php?id=".$id."&msg=upd");
    }

    public function UpdateMeta($id){ extract($_REQUEST); 
        $html_code=$this->clean('html_code');
        $sql="update product set html_code='".$html_code."' where id=".$id;
       
       // die($sql);
        $this->Query($sql);
        header("location:products_meta.php?id=".$id."&msg=upd");
    }

    public function AddSlider(){ extract($_REQUEST);
        $sort_order=$this->clean_amount('sort_order');

        $destinationpath=DIR_SLIDER; $qry="";
        if($_FILES['image_path']['name']!=""){
                $rnd=rand(999,10000);
                $image_path =$rnd."_".str_replace(" ", "", (basename($_FILES['image_path']['name'])));
                $targetpath=$destinationpath.$image_path;
                $res=move_uploaded_file($_FILES['image_path']['tmp_name'],$targetpath); 
                echo $targetpath;        
                $qry.=",image_path='".$image_path."'";
        }
echo "insert into pu_slider set heading='', sub_heading='', sort_order='".$sort_order."'".$qry;
        $this->Query("insert into pu_slider set heading='', sub_heading='', sort_order='".$sort_order."'".$qry);
        //header("location:slider.php?msg=suc");
    }

    public function UpdateSlider($id){ extract($_REQUEST);
        $sort_order=$this->clean_amount('sort_order');

        $destinationpath=DIR_SLIDER; $qry="";
        if($_FILES['image_path']['name']!=""){
                $rnd=rand(999,10000);
                $image_path =$rnd."_".str_replace(" ", "", (basename($_FILES['image_path']['name'])));
                $targetpath=$destinationpath.$image_path;
                $res=move_uploaded_file($_FILES['image_path']['tmp_name'],$targetpath);         
                $qry.=",image_path='".$image_path."'";
        }
        $this->Query("update pu_slider set sort_order='".$sort_order."'".$qry." where id=".$id);
        header("location:slider.php?msg=upd");
    }

    public function DeleteSlider($id){
        $res=$this->getRow("select * from pu_slider where id=".$id);
        unlink(DIR_SLIDER.$res['image_path']);
        $this->Query("delete from pu_slider where id=".$id);
        header("location:slider.php?msg=del");
    }

    /* Coupon */

    public function AddCoupon(){ extract($_REQUEST);

        $coupon_code=strtoupper($this->clean('coupon_code'));
        $product_category=strtoupper($this->clean('product_category'));
        $discount_type=$this->clean('discount_type');
        $discount_value=$this->clean_amount('discount_value');
        $start_date=date("Y-m-d",strtotime($start_date));
        $expire_date=date("Y-m-d",strtotime($expire_date));

        $this->Query("insert into coupon set description='', coupon_code='".$coupon_code."', product_category='".$product_category."', discount_type='".$discount_type."', discount_value='".$discount_value."', start_date='".$start_date."', expire_date='".$expire_date."'");
        header("location:coupons.php?msg=suc");
    }

    public function UpdateCoupon($id){ extract($_REQUEST);

        $coupon_code=strtoupper($this->clean('coupon_code'));
                $product_category=strtoupper($this->clean('product_category'));

        $discount_type=$this->clean('discount_type');
        $discount_value=$this->clean_amount('discount_value');
        $start_date=date("Y-m-d",strtotime($start_date));
        $expire_date=date("Y-m-d",strtotime($expire_date));

        $this->Query("update coupon set coupon_code='".$coupon_code."', product_category='".$product_category."', discount_type='".$discount_type."', discount_value='".$discount_value."', start_date='".$start_date."', expire_date='".$expire_date."' where id=".$id);
        header("location:coupons.php?msg=upd");
    }

    public function DeleteCoupon($id){ extract($_REQUEST);

        $this->Query("delete from coupon where id=".$id);
        header("location:coupons.php?msg=del");
    }

    public function UpdateMiscellaneous($id){ extract($_REQUEST);
        $cnt=$this->getRow("select * from coupon where coupon_code='".$coupon_code."'");
        if(!empty($cnt)){
        $type_value=$this->clean('type_value');
        $coupon_code=$this->clean('coupon_code');
        $this->Query("update miscellaneous set type_value='".$type_value.",coupon_code='".$coupon_code."' where id=".$id);
        header("location:miscellaneous.php?msg=upd");
        }else{
        header("location:miscellaneous.php?msg=inv");
        }

    }
}
$objFeatures = new Features();
?>