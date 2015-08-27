angular.module('recorderService', [])

    .factory('Recorder', function($http) {

        return {
            // save a record (pass in comment data)
            save : function(recorderData) {
                return $http({
                    method: 'POST',
                    url: '/api/recorder',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(recorderData)
                });
            }
        }

    });