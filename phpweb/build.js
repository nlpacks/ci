function getXMLHttpRequest() {
	var xmlHttp = null;
	try {
		xmlHttp = new XMLHttpRequest();
	} catch (e) {
		try {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {
			alert("Your browser does not support XMLHTTP!");
			return;
		}
	}
	return xmlHttp;
}
function submitRequest(xmlHttp, url, paramete) {
	xmlHttp.open("POST", escape(url), true);
	xmlHttp.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	xmlHttp.send(paramete);
}

function build(id, name, groups, array) {

	var str = "";
	var arraySize = array.length;
	for (i = 0; i < arraySize; i++) {
		if (document.getElementById(array[i]) != null) {
			element = document.getElementById(array[i]);

			index = array[i].lastIndexOf("_");
			tmp = array[i].substr(0, index - 1);
			index = tmp.lastIndexOf("_");
			tmp = tmp.substr(0, index);
			str += "&" + tmp + "=" + element.value;
		}
	}
	str = "pid=" + id + "&pname=" + name + "&groups=" + groups + "&ftype=build"
			+ str;

	var xmlHttp = getXMLHttpRequest();

	submitRequest(xmlHttp, "buildcheck.php", str);

	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			var content = "";
			if (xmlHttp.responseText == "ok") {
				submitbuild(str);
			} else if (xmlHttp.responseText == "exist") {
				var resubmit = confirm(" project ["
						+ name
						+ "] has been submit by others, are you sure submit it again ?");
				if (resubmit)
					submitbuild(str);
			} else
				alert(" task state check failed:" + xmlHttp.responseText);
		}
	}
}

function submitbuild(param) {
	var xmlHttp = getXMLHttpRequest();
	submitRequest(xmlHttp, "build.php", param);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			var content = "";
			if (xmlHttp.responseText == "success")
				content = "Submit success.";
			else {
				var returnstr = xmlHttp.responseText;
				content = "Submit Failed as the exception [" + returnstr + "].";
			}

			content = content
					+ "\n\nDo you want to open the tasks page ? If confirm yes, it will open task view ,otherwise stay on current page."
			var brower = confirm(content);
			if (brower) {
				location.href = "./showtask.php";
			}
		}
	}
}

function canceltask(taskid) {
	var xmlHttp = getXMLHttpRequest();

	submitRequest(xmlHttp, "canceltask.php", "id=" + taskid);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			var content = "";
			if (xmlHttp.responseText == "success")
				content = "task ["
						+ taskid
						+ "] has been canceled and it will reload task.";
			else if (xmlHttp.responseText == "fail") {				
				content = "you cann't cancel task [" + taskid
						+ "], only waiting task can be cancel.";
			}
			else
			{
				var returnstr = xmlHttp.responseText;
				content = "Cancel task [" + taskid
						+ "] Failed as the exception [" + returnstr
						+ "], please try it again later.";
			}
			// reload task page with ajax
			reloadtask();
			alert(content);
		}
	}
}

function reloadtask() {
	var xmlHttp = getXMLHttpRequest();
	// reload task page with ajax
	submitRequest(xmlHttp, "showtask.php", "action=refresh");
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			document.getElementById("taskcontent").innerHTML = xmlHttp.responseText;
		}
	}
}
function filtertask() {
	var state = document.getElementById("state").value;
	var developer = document.getElementById("developer").value;
	var starttime = document.getElementById("starttime").value;
	var endtime = document.getElementById("endtime").value;
	var projectid = document.getElementById("projectid").value;

	var str = "";
	if (developer != null && developer.length > 0)
		str = str + "&developer=" + developer;
	if (starttime != null && starttime.length > 0)
		str = str + "&starttime=" + starttime;
	if (endtime != null && endtime.length > 0)
		str = str + "&endtime=" + endtime;
	if (projectid != null && projectid.length > 0)
		str = str + "&projectid=" + projectid;

	var xmlHttp = getXMLHttpRequest();
	// reload task page with ajax
	submitRequest(xmlHttp, "showtask.php", "action=refresh&state=" + state
			+ str);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			document.getElementById("taskcontent").innerHTML = xmlHttp.responseText;
		}
	}
}

function resetfilter() {
	document.getElementById("state").value = "-1";
	document.getElementById("developer").value = "";
	document.getElementById("starttime").value = "";
	document.getElementById("endtime").value = "";
	document.getElementById("projectid").value = "";
}



function interrupttask(taskid) {

	var xmlHttp = getXMLHttpRequest();

	submitRequest(xmlHttp, "interrupttask.php", "id=" + taskid);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			var content = "";
			if (xmlHttp.responseText == "success")
				content = "task ["
						+ taskid
						+ "] has been stop and it's will reload task.";
			else if (xmlHttp.responseText == "fail") {				
				content = "you cann't stop task [" + taskid
						+ "], only start work task can be stop.";
			}
			else
			{
				var returnstr = xmlHttp.responseText;
				content = "Stop task [" + taskid
						+ "] Failed as the exception [" + returnstr
						+ "], please try it again later.";
			}
			// reload task page with ajax
			reloadtask();
			alert(content);
		}
	}

}