<?php
 
session_start();
$login = $_POST['login'];
$pas = $_POST['password'];
if ($login == 'admin' && $pas == 'admin')
  {
  session_start();
  $_SESSION['admin'] = true;
 
  }


  include("include/db.php");
  include("include/functions.php"); 
 
 
    if ($_POST["submit_add"])
    {
 if ($_SESSION['add_tovar'] == '1')
 {
 
      $error = array();
    
    // Перевірка полів
        
       if (!$_POST["form_title"])
      {
         $error[] = "Название игры";
      }
      
       if (!$_POST["form_price"])
      {
         $error[] = "Цена игры";
      }
          
       
      else
      {
        $result = mysqli_query($link,"SELECT * FROM steam WHERE id='{$_POST["games"]}'");
        $row = mysqli_fetch_array($result);
        $selectbrand = $row["Name"];
 
      }
      
 // проверка Чекбоксів
      
       if ($_POST["chk_visible"])
       {
          $chk_visible = "1";
       }else { $chk_visible = "0"; }
      
       if ($_POST["chk_new"])
       {
          $chk_new = "1";
       }else { $chk_new = "0"; }
      
       if ($_POST["chk_leader"])
       {
          $chk_leader= "1";
       }else { $chk_leader = "0"; }
      
       if ($_POST["chk_sale"])
       {
          $chk_sale = "1";
       }else { $chk_sale = "0"; }                   
      
                                      
       if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
            
       }else
       {
                           
                    mysqli_query($link,"INSERT INTO table_product (title,price,brand,seo_words,seo_description,mini_description,description,mini_features,features,new,leader,sale,visible,type_tovara,brand_id)
                        VALUES(                     
                            '".$_POST["form_title"]."',
                            '".$_POST["form_price"]."',
                            '".$selectbrand."',
                            '".$_POST["form_seo_words"]."',
                            '".$_POST["form_seo_description"]."',
                            '".$_POST["txt1"]."',
                            '".$_POST["txt2"]."',
                            '".$_POST["txt3"]."',
                            '".$_POST["txt4"]."',
                            '".$chk_new."',
                            '".$chk_leader."',
                            '".$chk_sale."',
                            '".$chk_visible."',
                            '".$_POST["form_type"]."',
                            '".$_POST["form_category"]."'                               
                        )");
                
      $_SESSION['message'] = "<p id='form-success'>Товар добавлен</p>";
    $id = mysqli_insert_id($link);  
                 
       if (empty($_POST["upload_image"]))
      {        
      include("actions/addprod.php");
      unset($_POST["upload_image"]);           
      } 
      
       if (empty($_POST["Image"]))
      {        
      include("actions/upload-gallery.php"); 
      unset($_POST["Image"]);                 
      }
}
 
    
 }else
 {
   $msgerror = 'Ой ой ой!'; 
 }            
}   
 
?>
<!DOCTYPE html>
<html lang="ru">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
    <meta name="keywords" content="test, site ,website" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style1.css" rel="stylesheet" type="text/css" />
    <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/admin-script.js"></script> 
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>  
    <title>Добавление товара</title>
</head>
<body>
<div id="block-body">
<?php
    include("include/block-header.php");
?>
<div id="block-content">
<div id="block-parameters">
<p id="title-page" >Добавление товара</p>
</div>
<?php
if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';
 
         if(isset($_SESSION['message']))
        {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        }
        
     if(isset($_SESSION['answer']))
        {
        echo $_SESSION['answer'];
        unset($_SESSION['answer']);
        } 
?>
 
<form enctype="multipart/form-data" method="post">
<ul id="edit-tovar">
 
<li>
<label>Название товата</label>
<input type="text" name="form_title" />
</li>
 
<li>
<label>Цена</label>
<input type="text" name="form_price"  />
</li>
 

 
<li>
<label>Короткий опис</label>
<textarea name="form_seo_description"></textarea>
</li>
 
<?php
$category = mysqli_query($link,"SELECT * FROM games");
    
If (mysqli_num_rows($category) > 0)
{
$result_category = mysqli_fetch_array($category);
do
{
  
  echo '
  
  <option value="'.$result_category["id"].'" >'.$result_category["Name"].'</option>
  
  ';
    
}
 while ($result_category = mysqli_fetch_array($category));
}
?> 
 
</select>
</ul> 
<label class="stylelabel" >Основна картинка</label>
 
<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
<input type="file" name="upload_image" />
 
</div>
 
<h3 class="h3click" >Короткий опис товара</h3>
<div class="div-editor1" >
<textarea id="editor1" name="txt1" cols="100" rows="20"></textarea>
        <script type="text/javascript">
            var ckeditor1 = CKEDITOR.replace( "editor1" );
            AjexFileManager.init({
                returnTo: "ckeditor",
                editor: ckeditor1
            });
        </script>
 </div>       
 
<h3 class="h3click" >Опис товара</h3>
<div class="div-editor2" >
<textarea id="editor2" name="txt2" cols="100" rows="20"></textarea>
        <script type="text/javascript">
            var ckeditor1 = CKEDITOR.replace( "editor2" );
            AjexFileManager.init({
                returnTo: "ckeditor",
                editor: ckeditor1
            });
        </script>
 </div>          
 
<h3 class="h3click" >Короткі характеристики</h3>
<div class="div-editor3" >
<textarea id="editor3" name="txt3" cols="100" rows="20"></textarea>
        <script type="text/javascript">
            var ckeditor1 = CKEDITOR.replace( "editor3" );
            AjexFileManager.init({
                returnTo: "ckeditor",
                editor: ckeditor1
            });
        </script>
 </div>        
 
<h3 class="h3click" >Характеристики</h3>
<div class="div-editor4" >
<textarea id="editor4" name="txt4" cols="100" rows="20"></textarea>
        <script type="text/javascript">
            var ckeditor1 = CKEDITOR.replace( "editor4" );
            AjexFileManager.init({
                returnTo: "ckeditor",
                editor: ckeditor1
            });
        </script>
  </div> 
 
<label class="stylelabel" >Галерея картинок</label>
 
<div id="objects" >
 
<div id="addimage1" class="addimage">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
<input type="file" name="galleryimg[]" />
</div>
 
</div>
 
<p id="add-input" >добавити</p>
     
<h3 class="h3title" >Настройка товара</h3>   
<ul id="chkbox">
<li><input type="checkbox" name="chk_visible" id="chk_visible" /><label for="chk_visible" >Показувати товар</label></li>
<li><input type="checkbox" name="chk_new" id="chk_new"  /><label for="chk_new" >Новий товар</label></li>
<li><input type="checkbox" name="chk_leader" id="chk_leader"  /><label for="chk_leader" >Популярний товар</label></li>
<li><input type="checkbox" name="chk_sale" id="chk_sale"  /><label for="chk_sale" >Товар з скидкою</label></li>
</ul> 
 
 
    <p align="right" ><input type="submit" id="submit_form" name="submit_add" value="Добавити товар"/></p>     
</form>
 
 
</div>
</div>
</body>
</html>
