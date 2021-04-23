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
        xampp: "C:\\xampp",
        hosts: "C:\\Windows\\System32\\drivers\\etc\\hosts",
    }

    $scope.server = {
        name: "localhost",
        address: "127.0.0.1",
        remote: "127.0.0.1",
    }

    $scope.toggleSettings = ()=> {
        $scope.control.modal = !$scope.control.modal
        M.updateTextFields()
    }

    $scope.saveSettings = (settings)=> {
        
        $scope.control.load = true

        service
            .save(settings)
            .then((response)=> {

                $timeout(()=> {
                    $scope.settings = response.data
                    $scope.toggleSettings()
                    $scope.control.load = false
                    console.log("saveSettings: ",  $scope.settings)
                } , 1000)

            })
    }

    const observer = new EventSource("./app/observers/observer.server.php" );

    observer.addEventListener("server", ServerObserver) 
    
    function ServerObserver(event) {
        console.log("ServerObserver: ", event.data)
        $scope.server = Object.assign($scope.server, JSON.parse(event.data))
        $scope.$apply();

    }

    const obs = new EventSource("./app/observers/observer.settings.php" );

    obs.addEventListener("settings", SettingsObserver)
    
    function SettingsObserver(event) {
        
        console.log("SettingsObserver: ", JSON.parse(event.data))

        let data = JSON.stringify(JSON.parse(event.data))
        
        if ( data == "{}" ) {
            $scope.toggleSettings()
            M.toast({html: "Você precisa configurar as pastas para usar o Software" });
        }
        
        if (JSON.stringify($scope.settings) != data) {
            $scope.settings = Object.assign($scope.settings, JSON.parse(event.data))
            $scope.$apply();
        }


    }

}