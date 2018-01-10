<html>
    <head>
        <style>
                form input {
                width: 150%;
                background-color:white;
                color: black;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;

            }

             button{
                width: 120px;
                background-color:#398439;
                color: white;
                padding: 14px 14px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            div {
                width: 400px;
                background-color:#f2f2f2;
                margin:50px;
                border-radius: 5px;
                padding: 20px;


            }
            table{
                width:60%;
                color:black;
                ;

            }

            td{
                font-weight: bold;
                width:120px;
                
            }
            
            input[type=button]{
                 width: 150px;
                background-color:#398439;
                color: white;
                padding: 14px 14px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;       
                
            }
            
                button{
                 width: 120px;
                background-color:#398439;
                color: white;
                padding: 14px 14px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                
            }
            
        </style>

    </head>
    <body>

    <center>
        

            <table>
                <tr>
                    <td colspan="8"><center><h1>DERNEKLER</h1></center></td>
                </tr>
                <tr>
                    <td>LOGO</td>
                    <td>ADI </td>
                    <td>ADRESİ </td>
                    <td>İL</td>
                    <td>İLÇE</td>
                    <td>SEMT</td>
                    <td>TELEFON NUMARASI </td>
                    <td>EMAİL </td>
                    <td>İLGİLİ KİŞİ</td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($data as $value)
                
                <tr>
                    @if($value->logo)
                      <td><img src="{{asset('logolar/'.$value->logo)}}" alt="{{$value->dernek_adi}}" style="width:100px;height:100px;"></td>
                      
                     @else
                     <td><img src="{{asset('logolar/default.gif')}}" alt="{{$value->dernek_adi}}" style="width:100px;height:100px;"> </td>
                     @endif
                      
                      
                      
                    <td>{{$value->dernek_adi}}</td>
                    
                    <td>{{$value->dernek_adresi}}</td>
                    <td>{{$value->il->adi}}</td>
                    <td>{{$value->ilce->adi}}</td>
                    <td>{{$value->semt->adi}}</td>
                    
                    
                    
                    
                    <td>{{$value->telefon}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->ilgili_kisi}}</td>
                
             <td><form id="Listeler" action="http://localhost/Dernekler/public/DernekGuncelle/{{$value->id}}" method="get"><button>Güncelle</button></form></td>
            <td><form id="Listeler" action="http://localhost/Dernekler/public/DernekSil/{{$value->id}}" method="get"><button>Derneği Sil</button></form></td>
                   

                </tr>

                  


                @endforeach
                
                <td ><form> <a href="http://localhost/Dernekler/public/DernekEkle"><input type="button" value="Dernek Ekle" position="center" </a></form></td>
            
            <p></p>
          
        
    </center>
    
    

</body>





</html>

