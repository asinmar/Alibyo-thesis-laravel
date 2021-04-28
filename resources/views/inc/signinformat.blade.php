<style>
body{
    background-color: rgb(255, 255, 248);
}
.loginbox{
    width: 100%;
    height: 650px;
    background: #042331;
    color: rgb(255, 255, 255);
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    border-radius: 15px;
    padding: 100px 30px;
}
.logo{
    width: 180px;
    height: 180px;
    position: absolute;
    left: calc(50% - 90px);
    top: 25px;
    background-color: #fff;
    border-radius: 10px;
}
h1{
    font-family:'Lucida Sans';
    margin-top: 80px;
    padding: 50px 0 10px;
    text-align: center;
    font-size: 30px;
    color: #fff;
}
.loginbox p{
    margin: 0;
    padding: 0;
    font-weight: bold;
    color:#fff;

}
.rem input{
    left: -200px;
   
}
.loginbox input{
    width: 100%;
    margin-bottom: 0px;
    
}
.loginbox input[type="text"],input[type='password']{
    border: none;
    border-bottom: 1px solid #fff;
    background:transparent;
    outline:none;
    height: 30px;
    color: #fff;
    font-size: 15px;
    font-family:Verdana;
  
  
}

#password{
    border: none;
    border-bottom: 1px solid #fff;
    background:transparent;
    outline:none;
    height: 30px;
    color: #fff;
    font-size: 15px;
    font-family:Verdana;
}
.loginbox input[type="submit"]{
    border: none;
    outline: none;
    height: 40px;
    background:#fff;
    font-size: 18px;
    border-radius: 10px;
    color: black;
    margin-bottom: 5px;
}
.loginbox input[type="submit"]:hover{
    cursor: pointer;
    background: darkgrey;
    color:#fff;
    
}
.loginbox a{
   font-family:Verdana;
    text-decoration: none;
    font-size:15px;
    line-height: 20px;
    color:rgb(255, 255, 255);
}
.loginbox a:hover{
    cursor: pointer;
    color:#3c9ac5;
}


@media only screen and (min-width: 768px ){
    .rem input{
        left: -200px;
    }
    .loginbox{
        width: 500px;
        height: 630px;
    }
    .loginbox input[type="text"],input[type='password']{ 
        height: 30px;
    }
    .loginbox a{
        line-height: 30px;
    }
}
@media only screen and (min-width: 1024px){
    .rem input{
        width: 13px;
        left: 15px;
    }
    .loginbox{
        width: 380px;
        height: 630px;
        top: 50%;
        left: 50%;
        
    }
}


</style>