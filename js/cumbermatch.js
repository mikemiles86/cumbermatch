angular.module("cumberapp", [])
    .controller("GameController", function($scope, $http) {
        $scope.gameData = {
            score : 0,
            rounds : 0,
            challenges : []
        }

        $scope.gameData.startGame = function() {
            $http({
               method : 'GET',
               url : 'data/data.json',
               cache: false,
            }).then(function successCallback(response) {
                $scope.gameData.challenges = response.data;
                console.log(response.data);
                $('#start').remove();
                $('#controls').addClass('hide');
                $('#options').addClass('hide');
                $('#left-column').removeClass('hide');
                $('.score-box').removeClass('hide');
                $scope.gameData.loadNextChallenge();
            }, function errorCallback(response) {
                // do nothing.
            });
        }

        $scope.gameData.playGame = function() {
            $('#controls').addClass('hide');
            $('#card .front .btn').addClass('hide');
            $('#options').removeClass('hide');
            $('.answer').removeClass('correct');
            $('.answer').removeClass('incorrect');
            $('.answer').addClass('hide');
            $scope.gameData.answer = {id : '', role: 'nobody', title : 'nothing', response : '', source : 'http://www.google.com'};
            $scope.gameData.answerStatus = "";
            $('#card').addClass('flipped');
        }

        $scope.gameData.guessImage = function(option_id) {
            var hash = $.md5($scope.gameData.challenge.image.id + option_id);

            $scope.gameData.rounds++;

            if (hash == $scope.gameData.challenge.answer.id) {
                $('.answer').addClass('correct');
                $scope.gameData.answerStatus = "Correct";
                $scope.gameData.challenge.image.url = "/cumbermatch/images/happy.jpg";
                $scope.gameData.score++;
                $scope.gameData.answerResponse = $scope.gameData.challenge.answer.correct;
            }
            else {
                $('.answer').addClass('incorrect');
                $scope.gameData.challenge.image.url = "/cumbermatch/images/angry.jpg";
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
            }, 2000);
        }

        $scope.gameData.loadNextChallenge = function() {
            shuffle($scope.gameData.challenges);
            shuffle($scope.gameData.challenges[0].images);
            var challenge = {
                image : $scope.gameData.challenges[0].images[0],
                answer : {
                    id : $.md5($scope.gameData.challenges[0].images[0].id + $scope.gameData.challenges[0].id),
                    role : $scope.gameData.challenges[0].role,
                    title : $scope.gameData.challenges[0].title,
                    source : $scope.gameData.challenges[0].images[0].source,
                    correct : shuffle(["Penglings","Jolly Good","Elementry","Smashing","Ha-Ha","Good Show","Quite Right"])[0],
                    incorrect : shuffle(["Boring","Simpleton","How Drole","I dare say","Dear God","Why I never","The nerve","How dare you","Bloody hell"])[0]
                },
                options : []
            };

            for (var x = 0; x < 4; x++) {
                challenge.options.push({
                    id : $scope.gameData.challenges[x].id,
                    title : $scope.gameData.challenges[x].title.name + ($scope.gameData.challenges[x].year ? ' (' + $scope.gameData.challenges[x].year + ')' : '')
                });
            }

            shuffle(challenge.options);
            $scope.gameData.challenge = challenge;
            $('#card .front .btn').removeClass('hide');
        }
    });

function shuffle(o){
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
}

