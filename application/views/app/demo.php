<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form enctype="multipart/form-data" method="post" name="fileinfo">
	  <label>File to stash:</label>
	  <input type="file" multiple name="commentImg1" required />
	</form>
	<div id="output"></div>
	<a href="javascript:sendForm()">Stash the file!</a>
	<script type="text/javascript">
	function sendForm() {
	  var oOutput = document.getElementById("output");
	  console.log(document.getElementsByName('commentImg1'));
	  var oData = new FormData(document.forms.namedItem("fileinfo"));

	  oData.append("accountID", "kxl1QuHKCD");
	  oData.append("orderID", "A150124073402355");
	  oData.append("commentType", "3");
	  oData.append("commentContent", "1124214312");
	  console.log(oData);

	  var oReq = new XMLHttpRequest();
	  oReq.open("POST", "/storeapi/addcomment", true);
	  oReq.onload = function(oEvent) {
	    if (oReq.status == 200) {
	      oOutput.innerHTML = "Uploaded!";
	    } else {
	      oOutput.innerHTML = "Error " + oReq.status + " occurred uploading your file.<br \/>";
	    }
	  };

	  oReq.send(oData);
	}
	</script>
</body>
</html>