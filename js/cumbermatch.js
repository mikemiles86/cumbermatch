angular.module("cumberapp", [])
    .controller("GameController", function($scope, $http) {
        $scope.gameData = {
            score : 0,
            challenges : 0,
        }

        $scope.gameData.startGame = function() {
                $('#start').remove();
                $('#controls').addClass('hide');
                $('#options').addClass('hide');
                $('#left-column').removeClass('hide');
                $('#flip').removeClass('hide');
                $('.score-box').removeClass('hide');
                $scope.gameData.loadNextChallenge();
        }

        $scope.gameData.playGame = function() {
            $('#controls').addClass('hide');
            $('#card .front .btn').addClass('hide');
            $('#options').removeClass('hide');
            $('#card').addClass('flipped');
            $('.answer').removeClass('correct');
            $('.answer').removeClass('incorrect');
            $('.answer').addClass('hide');
            $scope.gameData.answer = {id : '', role: 'nobody', title : 'nothing', response : '', source : 'http://www.google.com'};
            $scope.gameData.answerStatus = "";
        }

        $scope.gameData.guessImage = function(option_id) {
            var hash = $.md5($scope.gameData.challenge.image.id + option_id);

            $scope.gameData.challenges++;

            if (hash == $scope.gameData.challenge.answer.id) {
                $('.answer').addClass('correct');
                $scope.gameData.answerStatus = "Correct";
                $scope.gameData.challenge.image.url = "images/happy.jpg";
                $scope.gameData.score++;
                $scope.gameData.answerResponse = $scope.gameData.challenge.answer.correct;
            }
            else {
                $('.answer').addClass('incorrect');
                $scope.gameData.challenge.image.url = "images/angry.jpg";
                $scope.gameData.answerStatus = "Wrong";
                $scope.gameData.answerResponse = $scope.gameData.challenge.answer.incorrect;
            }

            $scope.gameData.answer = $scope.gameData.challenge.answer;
            $('#options').addClass('hide');
            $('#card .response').removeClass('hide');
            $('.answer').removeClass('hide');
            setTimeout(function() {
                $('#card').removeClass('flipped');
                $('#card .response').addClass('hide');
            }, 1000);
            setTimeout(function() {
                $scope.gameData.loadNextChallenge();
            }, 2500);
        }

        $scope.gameData.loadNextChallenge = function() {
            var d = new Date().getTime();
            $http({
               method : 'GET',
               url : 'get-challenge.php?cb=' + d,
               cache: false,
            }).then(function successCallback(response) {
                $scope.gameData.challenge = response.data;
                $('#controls').removeClass('hide');
                $('#card .front .btn').removeClass('hide');
            }, function errorCallback(response) {
                // do nothing.
            });
        }
    });
