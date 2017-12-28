function changeTitle(title) { document.title = title; }
var n1 = document.getElementById('ContentPlaceHolder1_PageTemplate_lblCategory');
var n2 = document.getElementById('ContentPlaceHolder1_PageTemplate_lblSubCategory');
var n3 = document.getElementById('ContentPlaceHolder1_PageTemplate_lblNewsDescription');
if (n1 == null){
changeTitle("Последние новости Компании");	
}else if (n3 == null){
changeTitle(n2.innerHTML);
}else{
changeTitle(n3.innerHTML);
}