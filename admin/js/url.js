/*here you use your own method to refine the url, as the code you provide in your question.*/ 
//var newUrl ="newUrl";//can leave it empty. This will be appended after the last /
var newUrl = refineUrl();//fetch new url

//here you pass whatever you want to appear in the url after the domain /
window.history.pushState("object or string", "Title", "/jeee/admin/"+newUrl );


/*Helper function to extract the URL between the last / and before ? 
  If url is www.example.com/file.php?f_id=55 this function will return file.php 
 pseudo code: edit to match your url settings  
*/ 
function refineUrl()
{
    //get full url
    var url = window.location.href;
    //get url after/  
    var value = url.substring(url.lastIndexOf('/') + 1);
    //get the part after before ?
    value  = value.split("?")[0];   
    return value;     
}
