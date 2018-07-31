console.log("js included"); // to see this message open dev tools using F12
$("nav a").each(function(a, _this) {
    $($(_this).find("span")[0]).css("color", "#" + (100 + parseInt(Math.random()*899)));
});
