<style>
    *{
        margin:0;
        padding: 0;
        list-style: none;
        text-decoration: none;
    }
    .sidebar{
        position: fixed;
        left: -250px;
        width: 250px;
        height: 100%;
        background: #042331;
        transition: all .5s ease;
        margin-top: -25px;
        z-index: 1;
    
    }
    .sidebar header{
        font-size: 22px;
        color: white;
        text-align: center;
        line-height: 70px;
        background: #063146;
        user-select: none;
    }
    .sidebar ul a{
        display: block;
        height: 100%;
        width: 100%;
        line-height: 65px;
        font-size: 20px;
        color: white;
        padding-left: 0px;
        box-sizing:border-box;
        text-decoration: none;
        transition: .4s;
    }
    ul li:hover a{
        padding-left: 10px;
        color:aquamarine;
    }
    .sidebar ul a i{
        margin-right:16px;
    }
    #check{
        display: none;
    }
    label #btn, label #cancel{
        position: absolute;
        cursor: pointer;
        background: #042331;
        border-radius: 3px;
    }
    label #btn{
        left: 0px;
        top: 70px;
        font-size: 30px;
        color: white;
        padding: 6px 12px;
        transition: all .5s;
        opacity: 0.2;
    }
    label #btn:hover{
        opacity: 1;
    }
    label #cancel{
        z-index: 1111;
        left:-195px;
        top: 75px;
        font-size: 20px;
        color: #0a5275;
        padding: 4px 9px;
        transition: all .5s ease;
    }
    #check:checked ~ .sidebar{
        left: 0;
    }
    #check:checked ~ label #btn{
        left: 250px;
        opacity: 0;
        pointer-events: none;
    }
    #check:checked ~ label #cancel{
        left: 210px;

    }
    .top-bar{
        background-color: #042331;
        width: 100%;
        height: 70px;
        color: aliceblue;
    }
    .top-bar h2{
        padding: 15px 25px 0px;
    }

    @media only screen and (max-width: 375px ){
        label #btn{
        left: 0px;
        top: 40px;
        font-size: 20px;
    }
    label #cancel{
        left:-195px;
        top: 45px;
        font-size: 20px;
  
    }
    #check:checked ~ label #cancel{
        left: 210px;

    }

        .sidebar header{
        font-size: 20px;
    }
        .sidebar ul a{
        height: 100%;
        width: 100%;
        line-height: 40px;
        font-size: 15px;
        padding-left: 0px;
    }
    .top-bar{
        height: 40px;
    }
    .top-bar h2{
        padding: 5px 25px 0px;
    }
    label #btn{
        opacity: 1;
    }
    }
</style>
<div class="top-bar">
  <h2>Hello</h2>
</div>
<input type="checkbox" id="check">
<label for="check">
    <i class="fas fa-bars" id="btn"></i>
    <i class="fas fa-times" id="cancel"></i>
</label>
<div class="sidebar">
    <header>Alibyo</header>
    <ul>
        <li><a href="/resident"><i class="fas fa-users"></i>Residents</a></li>
        <li><a href="/donation"><i class="fa fa-hand-holding-heart"></i>Donations</a></li>
        <li><a href="/relief"><i class="fas fa-boxes"></i>Reliefs</a></li>
        <li><a href="#"><i class="fa fa-qrcode"></i>QR-code</a></li>
        <li><a href="/smsSender"><i class="far fa-envelope"></i>Send SMS</a></li>
        <li><a href="#"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
    </ul>
</div>