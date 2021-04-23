(()=> {

    angular
        .module("vhost")
        .component("cards", {
            templateUrl: "app/cards/cards.html",
            controller: ["$scope", "card.service", "$timeout", CardsConstroller] 
        })

    function CardsConstroller($scope, service, $timeout) {

        var cardReset = {
            domain: "",
            folder: "",
            status: false,
            location: false,
        }

        $scope.control = {
            modal: false,
            msg: "",
            load: false,
        }

        $scope.card = angular.copy(cardReset)

        $scope.cards = []

        $scope.modal = false;

        service.load().then((cards)=> {
            console.log("Cards", cards.data)
            $scope.cards = cards.data
        })

        $scope.toggleModal = ()=> {
            $scope.modalControl = !$scope.modalControl
        }

        $scope.saveCard = (card)=> {
            
            $scope.card.load = true

            service.save(card).then((cards)=> {

                $timeout(()=> {

                    $scope.card.load = false
                    $scope.cards = cards.data 
                    $scope.toggleModal();
                    $scope.card = angular.copy(cardReset)

                    M.toast({html: "Servidor adcionado com sucesso" });

                }, 1000)
                
            })   
        }

        $scope.delCard = (card)=> {

            if  ( confirm ( "Deseja mesmo deletar este servidor" ) ) {

                service.del(card).then((cards)=> {
                    
                    $scope.cards = cards.data
                    $scope.card = angular.copy(card)

                    M.toast({html: "Servidor deletado com sucesso" });
                })

            }
        }

        $scope.editCard = (card)=> {
            $scope.card = card
            $scope.toggleModal()
        }

        $scope.keyEvent = ($event)=> {

            if ( $event.key == "Enter") {
                $scope.saveCard($scope.card)
            }

            if ( $event.key == "Escape") {
                $scope.toggleModal()
            }

        }

        reload = new EventSource("app/observers/observer.reload.php")

        reload.addEventListener("reload", ReloadObserver)
        
        function ReloadObserver(event) {

            console.log("ReloadObserver", event.data)

            var compare = String(JSON.stringify(angular.copy($scope.cards)))

            if ((event.data !== false) && (compare != String(event.data))) {
                $scope.cards = JSON.parse(event.data)
                $scope.$apply()
            }
        
        }

    }

}) ()
