(()=> {

angular
    .module("vhost")
    .component("cards", {
        templateUrl: "app/cards/cards.html",
        controller: ["$scope","card.service", CardsConstroller] 
    })

function CardsConstroller($scope, service) {

    $scope.control = {
        modal: false,
        msg: "",
        load: false,
    }

    $scope.card = {
        domain: "liber.dev",
        folder: "C:/liber",
        status: false,
        location: false,
    }

    $scope.cards = []

    $scope.modal = false;

    service.load().then((cards)=> {
        $scope.cards = cards.data
    })

    $scope.toggleModal = ()=> {
        $scope.modalControl = !$scope.modalControl
    }

    $scope.saveCard = (card)=> {
        
        $scope.card.load = true

        service.save(card).then((cards)=> {
        
            $scope.cards = cards.data 
            $scope.toggleModal();
            $scope.card.load = false
            
        })   
    }

    $scope.delCard = (card)=> {

        service.del(card).then((cards)=> {
            $scope.cards = cards.data
        })
    }

}

}) ()