angular
    .module("vhost")
    .component("header", {
        templateUrl: "app/header/header.html",
        controller: ["$scope", "header.service", "$timeout", HeaderConstroller],
    })

function HeaderConstroller($scope, service, $timeout) {
    
    $scope.control = {
        modal: false,
        load: false,
    }

    $scope.settings = {
        xampp: "xampp",
        hosts: "",
    }

    $scope.server = {
        name: "localhost",
        address: "192.168.1.10",
        remote: "192.168.1.*",
    }

    $scope.toggleSettings = ()=> {
        $scope.control.modal = !$scope.control.modal
        M.updateTextFields()
    }

    $scope.saveSettings = (settings)=> {
        
        $scope.control.load = true

        service.save(settings).then((response)=> {

            $timeout(()=> {
                $scope.settings = response.data
                $scope.toggleSettings()
                $scope.control.load = false
            } , 1000)

        })
    }

    const observer = new EventSource("./app/observers/observer.server.php" );

    observer.addEventListener("server", function(event) {

        $scope.server = JSON.parse(event.data)
        $scope.$apply();

    });

    const obs = new EventSource("./app/observers/observer.settings.php" );

    obs.addEventListener("settings", function(event) {

        if ( event.data == "{}" ) {
            $scope.toggleSettings()
            M.toast({html: "Você precisa configurar as pastas para usar o Software" });
        }
        
        if (JSON.stringify($scope.settings) != JSON.stringify(JSON.parse(event.data))) {
            $scope.settings = JSON.parse(event.data)
            $scope.$apply();
        }

    });

}