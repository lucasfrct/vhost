angular
    .module("vhost")
    .component("footer", {
        templateUrl: "app/footer/footer.html",
        controller: ["$scope", FooterController],
    })

function FooterController($scope) {

}