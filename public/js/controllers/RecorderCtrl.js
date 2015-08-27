angular.module('recorderCtrl', [])

// inject the Recorder service into our controller
    .controller('recorderController', function($scope, $http, Recorder) {
        // object to hold all the data for the new comment form
        $scope.recordertData = {};
        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // SAVE A RECORD ================
        $scope.submitRecord = function() {
            $scope.loading = true;

            // save the record info
            Recorder.save($scope.recorderData)
                .error(function(data) {
                    console.log(data);
                });
        };

    });