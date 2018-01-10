
<html lang="en">
    <head>

        <style>
            form input {
                width: 100%;
                background-color:white;
                color: black;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;

            }
            
              form input[type=file] {
              width: 100%;
                background-color:white;
                color: black;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;

            }
            
            form button[type=file]{
                width: 200px;
                background-color:#398439;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            form button{
                width: 200px;
                background-color:#398439;
                color: white;
                padding: 14px 20px;
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
                padding: 40px;


            }
            table{
                width:100%;
                color:#398439;


            }

            td{
                font-weight: bold;
            }




        </style>

    </head>
    <body>
    <center>
        <div>
            <form id="Dernekler" action="http://localhost/Dernekler/public/DernekEkle"  method="post" enctype="multipart/form-data" >
                <table border="0">
                    <tr>
                        {{csrf_field()}}
                        <td> Dernek Adı: </td>
                        <td><input type="text" name="dernek_adi" placeholder="Dernek Adı" required></td>
                        </tr>

                        <tr>
                        <td> Dernek Logo: </td>
                        <td><input type="file" name="logo" accept="image/*" ></td>
                        </tr>
                        
                        <tr>
                            <td> Dernek Adresi: </td>
                            <td><input type="text" name="dernek_adresi" placeholder="Açık Adres" ></td>
                            </tr>



                            <tr>
                                {{csrf_field()}}
                                <td>İl:</td>
                                <td>
                                    <select id="il_select" name="il">
                                        <option value="-1" selected hidden>Seçiniz</option>
                                        @foreach($iller as $il)
                                        <option value="{{$il->id}}">{{$il->adi}}</option>

                                        @endforeach
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>İlce:</td>
                                <td>
                            <select id="ilce_select" name="ilce">
                                
                                <option value="-1" selected hidden>Seçiniz</option>

                            </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Semt:</td>
                                <td>
                            <select id="semt_select" name="semt">
                                
                                <option value="-1" selected hidden>Seçiniz</option>

                            </select>
                                </td>
                            </tr>

                            <tr>
                                <td> Telefon Numarası: </td>
                                <td><input type="text" name="telefon" pattern="[5][0-9]{9}" placeholder="5xx xxx xx xx"></td>
                                </tr>

                                <tr>
                                    <td> Email: </td>
                                    <td><input type="text" name="email" pattern="[^ @]*@[^ @]*" placeholder="E-posta" required></td>
                                    </tr>

                                    <tr>
                                        <td> İlgili Kişi: </td>
                                        <td><input type="text" name="ilgili_kisi"placeholder="İlgili Kişi"required></td>
                                        </tr>


                                        </table> 
                                        <p></p>


                                        <button id="sub">Dernek Ekle</button>


                                        </form>

                                        </div>
                                        <span id="result"></span>




                                        </center>


                                        <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>

                                        <script>

                                            $(function () {
                                                $('#Dernekler').submit(function () {
                                                    alert('now starting submit');
                                                    return true;
                                                });
                                                $("#sub").click(function () {
                                                    $('#Dernekler #submit').click();
                                                });


                                                //
                                            });

                                            $('#il_select').change(function (event) {
                                                //ajax

                                                var il_id = event.target.value;
                                                $.get("IlinIlceleriniGetir/" + il_id, function (data) { //ajax ile veri çekme (get fonkk.)

                                                    $.each(data, function (index, ilce) {
                                                        $('#ilce_select').append('<option value="'+ilce.id+'">' + ilce.adi + "</option>");
                                                    });
                                                });

                                            });




                                             $('#ilce_select').change(function (event) { //Kullanıcı ilçeyi değiştirdiği sürece( select id=ilce_select)
                                                
                                                var ilce_id = event.target.value; //event->select değişince değişenelemanı artık ilce_id
                                                
                                                $.get("IlceninSemtleriniGetir/" + ilce_id, function (data) { //ilce_id controllerdaki fonksiyonun parametresi
                                                    // ilce id si ile IlceninSemtleriniGetir route'ına beni yönlendiriyo.

                                                    $.each(data, function (index, semt) { //her bir değişiklik için
                                                        $('#semt_select').append('<option value="'+semt.id+'">' + semt.adi + "</option>");
                                                        //semt selectini bize artık adını göstererek(semt.adi) göster.

                                                    });
                                                });

                                            });
                                        </script>

                                        </body>
                                        </html>
