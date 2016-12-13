<?php include "../inc/header.php" ?>

<script>

  runTests()
  function runTests() {
    register()
    setTimeout(function() {
      login()
      setTimeout(function() {
        updateAccount()
      }, 5000)
    }, 5000)
  }

  function register() {
    var email = "12343@test.com"
    var fullname = "Testy Mctesterson"
    var username = "t123"
    var password = ""
    post("/resources/ajax/functions.php", {"func": "register", "email": email, "fullname": fullname, "username": username, "password": password}, function(r) {
      r = JSON.parse(r)
      if (r['status'] == "failed") addAlert(r["message"])
      else addAlert(r["status"])
    })

    var password = "password123"
    post("/resources/ajax/functions.php", {"func": "register", "email": email, "fullname": fullname, "username": username, "password": password}, function(r) {
      r = JSON.parse(r)
      if (r['status'] == "failed") addAlert(r["message"])
      else addAlert(r["status"])
    })

    var email = "tester1232@test.com"
    var fullname = "Testy Mctesterson"
    var username = "teste2234"
    post("/resources/ajax/functions.php", {"func": "register", "email": email, "fullname": fullname, "username": username, "password": password}, function(r) {
      r = JSON.parse(r)
      if (r['status'] == "failed") addAlert(r["message"])
      else addAlert(r["status"])
    })
  }

  function login() {
    var username = "t123"
    var password = "password123"
    post("/resources/ajax/functions.php", {"func": "login", "username": username, "password": password}, function(r) {
      r = JSON.parse(r)
      if (r['status'] == "failed") addAlert(r["message"])
      else addAlert(r["status"])
    })

    var username = "tester123"
    var password = ""
    post("/resources/ajax/functions.php", {"func": "login", "username": username, "password": password}, function(r) {
      r = JSON.parse(r)
      if (r['status'] == "failed") addAlert(r["message"])
      else addAlert(r["status"])
    })
  }

  // function createBet() {
  //   var title = document.getElementById("bet-title").value
  //   var outcomeValues = []
  //   for (var i = 0; i < outcomes.children.length; i++) outcomeValues.push(outcomes.children[i].value)
  //
  //   post("/resources/ajax/functions.php", {"func": "createBet", "title": title, "outcomes": outcomeValues.join(":")}, function(r) {
  //     r = JSON.parse(r)
  //     if (r['status'] == 'ok') {
  //       window.location.href = r['path']
  //     }
  //     addAlert(r['message'])
  //   })
  // }
  //
  // function placeBet() {
  //   var amount = document.getElementById("bet-amount").value
  //
  //   post("/resources/ajax/functions.php", {"func": "placeBet", "betid": 1, "outcome": outcome, "amount": amount}, function(r) {
  //     r = JSON.parse(r)
  //     addAlert(r['message'])
  //     if (r['status'] == 'ok') {
  //       setTimeout(function() {
  //         location.reload()
  //       }, 1500)
  //     }
  //   })
  // }
  //
  // function transfer() {
  //   var amount = document.getElementById("transfer-amount").value
  //
  //   post("/resources/ajax/functions.php", {"func": "transfer", "destination": toggleTransferDestination, "account": toggleTransferAccount, "amount": amount}, function(r) {
  //     r = JSON.parse(r)
  //     addAlert(r['message'])
  //     if (r['status'] == 'ok') {
  //       setTimeout(function() {
  //         location.reload()
  //       }, 1500)
  //     }
  //   })
  // }
  //
  // function updateAccount() {
  //   var email = document.getElementById("account-email").value
  //   var fullname = document.getElementById("account-fullname").value
  //   var username = document.getElementById("account-username").value
  //   var bio = document.getElementById("account-bio").value
  //
  //   post("/resources/ajax/functions.php", {"func": "updateAccount", "email": email, "fullname": fullname, "username": username, "bio": bio}, function(r) {
  //     r = JSON.parse(r)
  //     if (r['status'] == "ok") {
  //       document.getElementById("header-account").href = "/user/" + r['username'] + "/"
  //     }
  //     addAlert(r['message'])
  //   })
  // }
  //
  // function addBank() {
  //   var routing = document.getElementById("bank-routing").value
  //   var account = document.getElementById("bank-account").value
  //
  //   post("/resources/ajax/functions.php", {"func": "addBank", "routing": routing, "account": account}, function(r) {
  //     r = JSON.parse(r)
  //     addAlert(r['message'])
  //     if (r['status'] == 'ok') {
  //       setTimeout(function() {
  //         location.reload()
  //       }, 1500)
  //     }
  //   })
  // }
  //
  // function removeBank() {
  //   var routing = document.getElementById("bank-routing").value
  //   var account = document.getElementById("bank-account").value
  //
  //   post("/resources/ajax/functions.php", {"func": "removeBank", "account": toggleRemoveAccount}, function(r) {
  //     r = JSON.parse(r)
  //     addAlert(r['message'])
  //     if (r['status'] == 'ok') {
  //       setTimeout(function() {
  //         location.reload()
  //       }, 1500)
  //     }
  //   })
  // }
  //
  // function transfer() {
  //   var amount = document.getElementById("transfer-amount").value
  //
  //   post("/resources/ajax/functions.php", {"func": "transfer", "destination": toggleTransferDestination, "account": toggleTransferAccount, "amount": amount}, function(r) {
  //     r = JSON.parse(r)
  //     addAlert(r['message'])
  //     if (r['status'] == 'ok') {
  //       setTimeout(function() {
  //         location.reload()
  //       }, 1500)
  //     }
  //   })
  // }

</script>

<?php include "../inc/footer.php" ?>
