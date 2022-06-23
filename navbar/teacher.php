<div class="nav-container">
    <div class="navbar">
      <h1 class="currentpage"><?= $title ?></h1>
        <div class="full-navbar">
          <a href="student_list.php"><button class="navbutton">Student list</button></a>
          <a href="assig_teacher.php"><button class="navbutton">Assignment</button></a>
          <a href="../login_register/logout_handler.php"><button class="navbutton logout">Logout</button></a>
        </div>
        <img class="nav-logo" src="../img/navbar.png" alt="" onclick="navToggle()">
    </div>
    <div class="small-navbar invis-nav">
      <a href="student_list.php"><button class="navbutton-sm">Student list</button></a>
      <a href="assig_teacher.php"><button class="navbutton-sm">Assignment</button></a>
      <a href="../login_register/logout_handler.php"><button class="navbutton-sm logout-sm">Logout</button></a>
    </div>
</div>
<script>
  const smNav = document.querySelector(".small-navbar");
  function navToggle(){
    console.log("x")
    if(smNav.classList.contains("invis-nav")){
      smNav.classList.remove("invis-nav");
    }else {
      smNav.classList.add("invis-nav");
    }
  }
</script>


