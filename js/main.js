window.location.hash = "/news/uk-djlizzo-378163771"
var initialShareButton = document.getElementById("initialShareButton");
var popupShareButton = document.getElementById("popupShareButton");

initialShareButton.addEventListener("click", function () {
	popupShareButton.parentElement.style.display = "block";
	return false;
});

document.addEventListener("click", function (event) {
	console.log(event.target);
	if (popupShareButton.parentElement.style.display == "block") {
		if (event.target != popupShareButton.parentElement && event.target != popupShareButton && event.target != initialShareButton && event.target != initialShareButton.children[0] && event.target != initialShareButton.children[0].children[0]) {
			popupShareButton.parentElement.style.display = "none";
		}
	}
	return false;
});

popupShareButton.addEventListener("click", function () {
	var url = window.location.href;
	navigator.clipboard.writeText(url);
	popupShareButton.innerHTML = "Copied!";
	setTimeout(function () {
		popupShareButton.innerHTML = "Copy Link";
	}, 3000);
});
