<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" >

    <title>Ecommerce</title>
  </head>
   <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Ecommerce</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-4">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contatos</a>
          </li>
      </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Cadastr-se</a>
        </li>
      </ul>

      </div>
    </nav>
    
    <div class="container">
      <div class="row mt-5">
            <div class="col">
                <div class="row border" id="img-view"></div>
                <div class="row" id="img-min"></div>
            </div>
            <div class="col" id="description"></div>
          
      </div>


    </div>
    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/bootstrap/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="../vendor/bootstrap/js/popper.min.js" ></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js" ></script>
   <script src="../vendor/products.js"></script>
   <script>
       
       const imgView=document.getElementById('img-view');
       const imgMin=document.getElementById('img-min');
       const description=document.getElementById('description');

       const url=window.location.href;
       const urlSplit=url.split('=');

     // console.log(urlSplit);
        
        const viewProducts=products.find((p)=>{
            return p.id===urlSplit[1];
        })

        //console.log(viewProducts);
        let img=`<img src="img/${viewProducts.img}" >`;

        imgView.innerHTML=img;

        let descriptionView=`
            <div class="ml-auto">
                <h2 class="text-center mb-5 mt-2">${viewProducts.title} 
                    Marca - ${viewProducts.brand} </h2>
                <h4 class="text-justify">${viewProducts.description}</h4>
                <h4 class="mt-5">
                    <strong>Valor: ${viewProducts.price}</strong></h4>
            </div>
        `;
         
        description.innerHTML=descriptionView;
        
        image_products.map((f)=>{
            if(f.id_products===urlSplit[1]){
            let min=`
                <div class="col border">
                    <a href="" data-img="${f.id}">
                        <img src="../_arquivos/produtos/${f.img}" 
                        style="width:64px;height:auto;
                        margin-left:25%;">
                    </a>
                </div>

            `;

            imgMin.innerHTML +=min;

            }
        }).join('');

        const imgButtons=document.querySelectorAll('[data-img]');
       // console.log(imgButtons)

        imgButtons.forEach((f)=>{
            f.addEventListener('mouseover',()=>{
                let results=image_products.find((img)=>{
                    return img.id===f.dataset.img;//data-img
                })

                
                let myImage=`<img src="../_arquivos/produtos/${results.img}">`;
                
                imgView.innerHTML=myImage;
            })

           
        })



   </script>


   </body>
   </html>