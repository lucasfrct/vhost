angular
    .module("vhost")
    .component("header", {
        templateUrl: "app/header/header.html",
        controller: ["$scope", HeaderConstroller],
    })

function HeaderConstroller($scope) {
    $scope.header = {
        server: "192.168.1.10",
        host: "::1"
    }

    const observer = new EventSource("./app/header/header.service.php" );

    observer.addEventListener("header", function(event) {
        $scope.header = JSON.parse(event.data)
        $scope.$apply();
    });



}