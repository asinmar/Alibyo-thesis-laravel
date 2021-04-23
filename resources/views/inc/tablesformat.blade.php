<style>
    .wrapper{
        margin: 30px 20px 0px;
        border:1px solid;
        border-radius: 10px;
        padding: 10px;
    }
    .modal-bg h2{
        font-family:'Lucida Sans';
        
    }
    .restable{
        height: 500px;
        width: 100%;
        overflow-y: auto;
    }
    .modal-bg{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: rgb(0,0,0,0.2);
        display: flex;
        justify-content: center;
        align-items: center;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s,opacity 0.5s;
    }
    .modal-display{
        position: relative;
        background-color: white;
        height: 80%;
        width: 35%;
        border: 3px solid black;
        border-radius: 10px;
    }
    .modal-display h2{
        text-align: center;
    }
    .bg-active{
        visibility: visible;
        opacity: 1;
    }
    table,thead,tr{
        border:1px solid black;
    }
   .modal-close{
       font-size: 30px;
       position: absolute;
       top: 5px;
       right: 15px;
       cursor: pointer;

   }
   .modal-display .reg-form text {
        margin-left: 50px;
        border: none;
        border-bottom: 1px solid rgb(197, 25, 25);
        background:transparent;
        outline:none;
        height: 50px;
        font-size: 15px;
        font-family:Verdana; 
       
   }
   .modal-display p{
       padding: 0;
       margin: 0px;
   }
   .wrapper h1{
       margin-bottom:0px;
   }
 
</style>
