<style>
  .header-row{
    border: 1px solid green;
    background-color: #042331; 
  }
  .header-col{
  color: aliceblue;
   
  }
  .sidebar-col{
    height: 300px;
    border:blue;
    background-color: blanchedalmond;
  }
  .my-rows{
    height: 200px;
    border: 1px solid yellow;   
  }
  @media (min-width:200px){
    .header-row{
      height: 40px;
    }
    .header-col-so{
      font-size: 15 px;
      color: aliceblue;
      text-align: right;
    }
    
  }
  @media(min-width:576px){
    .header-row{
      height: 50px;
    }
    .header-col-so{
      font-size: 18px;
      color: aliceblue;
      text-align: right;
    }
  }
  @media(min-width:720px){
    .header-row{
      height: 70px;
    }
    .header-col-so{
      font-size: 20px;
      color: aliceblue;
      text-align: right;
    }
  }
</style>
<div class="container-fluid">
  <div class="row header-row justify-content-between align-items-center">
    <div class="col-xl-11 col-lg-10 col-md-10 col-sm-10 col-9 header-col">
      <h3>Alibyo</h3>
    </div>
  </div>
</div>

  