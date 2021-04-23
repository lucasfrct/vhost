angular
    .module("vhost")
    .service("header.service", ["$http", HeaderService])

function HeaderService($http) {
    var that = this

    that.url = "./app/header/header.service.php"

    that.save = (settings)=> {

        console.log("settings: ", settings)
        return $http({ method: "POST", url: that.url, data: settings })
    }
}