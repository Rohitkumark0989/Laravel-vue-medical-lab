<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style>
      .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}
#logoeng{
  margin-bottom:-92px;
  margin-left:10px;
}
#logoeng img{
   width:200px;
}
#logourdu{
  margin-top:-73px;
  margin-left:499px;
}
#logourdu img{
   width:200px;
}
h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: white;
  background-color:blue;
  text-align:center;
  font-size:17px;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 10px;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  
}
#f-add{
  position: relative;
  top:10px;
  margin-left:-102px;
}

    </style>  
  </head>
  <body>
    <header class="clearfix">
     <!-- <div id="logoeng">
        <img src="img/doctors/bhitaieng.jpeg">
     </div>  -->
     <div id="logo">
        <img src="img/doctors/logo.png">
      </div>
       <!-- <div id="logo">
        <img src="img/doctors/logo.png">
      </div>  -->

      <!-- <div id="logourdu">
        <img src="img/doctors/bhitaiurdu.jpeg">
      </div> -->
      <h1></h1>
      <div id="company" class="clearfix">
        <div>ADDRESS</div>
        <div>Karachi</div>
      </div>
      <div id="project">
        <div><span>NAME</span> {{$name}}</div>
        <div><span>DATE</span>{{$date}}</div>
        <div><span>GENDER</span>{{$gender}}</div>
        <div><span>AGE</span>{{$age}}</div>
        <div><span>MOBILE</span>{{$mobile}}</div>
        <div><span>CNIC</span> {{$cnic}}</div>
        <div><span>ADDRESS</span> {{$address}}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">No</th>
            <th class="desc">TEST</th>
             <th></th>
            <th class="qty">PRICE</th> 
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($tests as $key => $test)
          <tr>
            <td class="service">{{$key+1}}</td>
            <td class="desc">{{$test['label']}}</td>
             <td class="unit"></td>
            <td class="qty">{{$test['price']}}</td> 
            <td class="total"></td>
          </tr>
          @endforeach  
          <!-- <tr>
            <td class="service"></td>
            <td class="desc"></td>
             <td class="unit">SUBTOTAL</td>
            <td class="qty">$5,200.00</td> 
            <td class="total"></td>
          </tr> -->
          <tr>
            <td class="grand total" colspan="3">SUBTOTAL</td>
            <td class="grand total">{{$subtotal}}</td>
            <td></td>
          </tr>
          @if(($discount) > 0)
          <tr>
            <td colspan="3">DISCOUNT</td>
            <td class="total">{{$discount}}</td>
            <td></td>
          </tr>
          @endif
          <tr>
            <td colspan="3" class="grand total">TOTAL</td>
            <td class="grand total">{{$total}}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
      
    </main>
    <footer>
         <span id="f-add">California</span>
    </footer>
  </body>
</html>