angular
    .module("vhost")
    .service("card.service", ["$http", CardService])

function CardService($http) {
    var that = this

    that.url = "app/cards/card.service.php"

    that.save = (card)=> {
        card.action = "save"
        return $http({ method: "POST", url: that.url, data: card })
    }

    that.del = (card)=> {
        card.action = "delete"
        return $http({ method: "POST", url: that.url, data: card })
    }

    that.load = ()=> {
        return $http({ method: "GET", url: that.url })
    }
}