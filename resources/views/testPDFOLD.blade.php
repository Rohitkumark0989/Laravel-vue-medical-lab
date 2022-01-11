<!DOCTYPE html>
<html>
<head>
    <title>{{$name}}</title>
    <style>
      body{
        margin:0;
        
      }
      .header-sec{
        position: relative;
        width:100%;
        height:100px;
        border:2px solid black;
        margin-top:0px;
      }
      /* .left-img{
        position:absolute;
        width:32%;
        height:97px;
        border:2px solid red;
        background-image: url("img/doctors/doctor_1.jpg");
      } */
      /* .mid-img{
        position:absolute;
        width:32%;
        height:97px;
        padding-left: 40px;
        margin-left:514px;
        border:2px solid green;
        background-image: url("img/doctors/doctor_1.jpg");
      } */

      /* .right-img{

        width:32%;
        height:97px;
        float:right;
        border:2px solid orange;
        background-image: url("img/doctors/doctor_1.jpg");
      } */

      .body-sec{
        width:100%;
        margin:20px;
        height:auto;
        position: relative;
        border:2px solid black;
      }
      .primary-detail{

        height:50px;  
        display:inline-block;
        margin-top:20px;
        padding:10px;
        

      }
      .footer-sec{
        position:fixed;
        left:0px;
        bottom:0px;
        border: 2px solid black;
        width:100%;
        height:40px;
        background-color:#000080;
        color:white;
        
      }
      .footer-content{
        position:absolute;
        padding-top:10px;
      }
      table, th, td {
         border:1px solid black;
      }
      .tiledBackground {
        background-image: url(https://www.mozilla.org/media/img/logos/firefox/logo-quantum.9c5e96634f92.png);
        background-size: 150px;
        width: 300px;
        height: 100px;
        color: pink;
      }
    </style>  
</head>
<body>
    <!-- <div class="header-sec">
       <div class="left-img">
          Left img
       </div>
       <div class="mid-img">
         Mid img
       </div>
       <div class="right-img">
         right img
       </div>
    </div> -->
    <table style="width:100%;">
       <tr >
         <td class="tiledBackground" style="border:none;background-image:url(img/doctors/doctor_1.jpg);background-repeat:no-repeat;background-size:auto 50px; background-size: cover;" ></td>
         <td class="tiledBackground" style="border:none;background-image:url(img/doctors/doctor_2.jpg);background-repeat:no-repeat;background-size:auto 50px; background-size: cover;"></td>
         <td class="tiledBackground" style="border:none;background-image:url(img/doctors/doctor_3.jpg);background-repeat:no-repeat;background-size:auto 50px; background-size: cover;"></td>
      </tr>  
    </table>  
    <table style="width:100%; margin-top:20px;" >
        <tr>
          <th>Date</th>
          <td>{{$date}}</td>
          <th>Gender</th>
          <td>{{$gender}}</td>
          <th>Age</th>
          <td>{{$age}}</td>
        </tr>
        <tr>
          <th>Name</th>
          <td>{{$name}}</td>
          <th>Mobile</th>
          <td>{{$mobile}}</td>
          <th>CNIC</th>
          <td>{{$cnic}}</td>
        </tr>
        <tr>
          <th> Address</th>
          <td colspan="5">{{$address}}</td> 
        </tr>  
        
    </table>
    <div class="body-sec">
    <table  style="width:100%;  margin:20px;">
        <tr height="70px;" style="background-color:grey;font-size:20px;">
          <th>TEST</th>
          <th>PRICE</th>
        </tr>
        @foreach($tests as $key => $test)

        <tr height="40px;" style="font-size:17px;">
          <th style='border:none;'>{{$test['label']}}</th>
          <td style='border:none;'>{{$test['price']}}</td>
        </tr>
        @endforeach

        <tr style="background-color:grey;font-size:20px;">
          <th>Subtotal</th>
          <td>{{$subtotal}}</td>
        </tr>
        @if(($discount) > 0)
        <tr style="font-size:20px;">
          <th>Discount</th>
          <td>{{$discount}}</td>
        </tr>
        @endif
        <tr style="font-size:20px;">
          <th>Total</th>
          <td>{{$total}}</td>
        </tr>
    </table>
      <!-- <div class="primary-detail1">
          <strong>Name : </strong>
          <span>Rohit</span>
      </div> -->

    </div>
       
    <div class="footer-sec">
      <span class="footer-content">Footer</span>
    </div>      
</body>
</html>