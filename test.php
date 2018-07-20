<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NCTTC2016</title>
<link href='http://fonts.googleapis.com/css?family=Trocchi' rel='stylesheet' type='text/css' />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/js-image-slider.css" rel="stylesheet" type="text/css" charset="utf-8" />
<script src="js/js-image-slider.js" type="text/javascript" charset="utf-8"></script>
        
</head>

<body>
<div class="wrapper">
            <form method="post" name="frmAbstract" id="frmAbstract">

 			<form action="#n" name="theForm">

    <label for="gender">Gender: </label>
    <input type="radio" name="genderS" value="1" checked> Male
    <input type="radio" name="genderS" value="0" > Female<br><br>
    <a href="javascript: submitForm()">Search</A>
</form>
   </form> 
</div>
<script>
function submitForm() {
var radios = document.getElementsByName('genderS');

for (var i = 0, length = radios.length; i < length; i++)
{
 if (radios[i].checked)
 {
  // do whatever you want with the checked radio
  alert(radios.length);

  // only one radio can be logically checked, don't check the rest
  break;
 }
}

}
</script>
</body>
</html>
