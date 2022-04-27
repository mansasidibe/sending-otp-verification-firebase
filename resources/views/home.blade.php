<html>
    <head>
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
<body>
<div class="container">
    <h3 style="text-align:center; margin-top:30px">Verification OTP Laravel - Firebase</h3><br>
    <div class="alert alert-danger" id="error" style="display: none;"></div>
    <div class="card">
      <div class="card-header">
        Numéro
      </div>
      <div class="card-body">
        <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>
        <form>
            <label>Téléhone :</label>
            <input type="text" id="number" class="form-control" placeholder="+255 XXXXXXXXX"><br>
            <div id="recaptcha-container"></div><br>
            <button type="button" class="btn btn-success" onclick="SendCode();">Envoyer un Code</button>
        </form>
      </div>
    </div>

    <div class="card" style="margin-top: 10px">
      <div class="card-header">
        Verification code
      </div>
      <div class="card-body">
        <div class="alert alert-success" id="successRegsiter" style="display: none;"></div>
        <form>
            <input type="text" id="verificationCode" class="form-control" placeholder="Entrer Verification Code"><br>
            <button type="button" class="btn btn-success" onclick="VerifyCode();">Verifier Code</button>
        </form>
      </div>
    </div>

</div>

<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<script>

  var firebaseConfig = {
    apiKey: "AIzaSyD2GtAjs6T2aeOLd_KOJDgO59K4GAxLEwo",
    authDomain: "http://127.0.0.1:8000",
    databaseURL: "http://127.0.0.1:8000",
    projectId: "laravel-notification-3d7e6",
    storageBucket: "XXXX.appspot.com",
    messagingSenderId: "XXXX",
    appId: "XXXX",
    measurementId: "XXXX"
  };

  firebase.initializeApp(firebaseConfig);
</script>

<script type="text/javascript">

    window.onload=function () {
      render();
    };

    function render() {
        window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    function SendCode() {

        var number = $("#number").val();

        firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {

            window.confirmationResult=confirmationResult;
            coderesult=confirmationResult;

            $("#sentSuccess").text("Message Sent Successfully.");
            $("#sentSuccess").show();

        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });

    }

    function VerifyCode() {

        var code = $("#verificationCode").val();

        coderesult.confirm(code).then(function (result) {
            var user=result.user;

            $("#successRegsiter").text("You Are Register Successfully.");
            $("#successRegsiter").show();

        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }

</script>

</body>
</html>
