<style>
    body{
        background-color: rgb(255, 255, 248);
    }
    .regbox{
        width: 100%;
        height: 100%;
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
 
    h1{
        font-family:'Lucida Sans';
        margin-top: -120px;
        padding: 50px 0 10px;
        text-align: center;
        font-size: 20px;
        color: #fff;
    }
    .regbox p{
        margin: 0;
        padding: 0;
        font-weight: bold;
        color:#fff;
        font-size: 15px;
    
    }
    .regbox input{
        width: 100%;
        margin-bottom: 10px;
        
    }
    .regbox input[type="text"],input[type='password'],input[type='email']{
        border: none;
        border-bottom: 1px solid #fff;
        background:transparent;
        outline:none;
        height: 40px;
        color: #fff;
        font-size: 15px;
        font-family:Verdana;    
    }
    #show{
        display:none;

    }
    label #eye{
        font-size: 20px;
        position: absolute;
        cursor: pointer;
        background: none;
        border-radius: 3px;
        margin-top: -110px;
        margin-left: 170px;
    }
    #show:checked ~ label #eye{
        color: red;
    }
    .regbox input[value='Submit']{
        border: none;
        outline: none;
        width: 40%;
        height: 30px;
        background:rgb(57, 174, 228);
        font-size: 18px;
        border-radius: 10px;
        color: black;
        margin-bottom: 5px;
        float: right;
    }
    .regbox input[value='Return']{
        border: none;
        outline: none;
        width: 40%;
        height: 30px;
        background:rgb(223, 55, 55);
        font-size: 18px;
        border-radius: 10px;
        color: black;
        margin-bottom: 5px;
        float: left;
    }
    .regbox input[type="submit"]:hover{
        cursor: pointer;
        background: darkgrey;
        color:#fff;
        
    }
    @media only screen and (min-width:768px){
        .regbox{
            width: 600px;
            height: 700px;
        }
        label #eye{         
            margin-left: 300px;
        
        }
    }
    @media only screen and (min-width:1000px){
        .regbox{
            width: 700px;
            height: 650px;
        }
        label #eye{         
            margin-left: 210px;
        
        }
    }
  
    
    
</style>

<script>
    
    function showPass(){
        var x= document.getElementById("myInput");
        if(x.type == "password"){
            x.type = "text";
        }
        else{
            x.type = "password"
        }
    }X
    
</script>