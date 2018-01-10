
<html>
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




        </style>
    </head>
    <body>
    <center>

        <div>
            <form id="Dernekler" action="http://localhost/Dernekler/public/DernekGuncelle"  method="post" enctype="multipart/form-data">

                <table border="0">
                    <tr>
                    <input type="hidden" name="dernek_id" value="{{$id}}">
                        {{csrf_field()}}
                        <td> Dernek Adı: </td>
                        <td><input type="text" name="dernek_adi" value="{{$dernek->dernek_adi}}"></td>
                            </tr>


                            <tr>
                                <td> Dernek Logo: </td>
                                @if($dernek->logo)
                                <td><img type="file" name="logo" src="{{asset('logolar/'.$dernek->logo)}}"style="width:100px;height:100px;"</img><input type="file" name="logo" value="{{$dernek->logo}}" accept="image/*" > </td>


                                @else
                                <td><img  src="{{asset('logolar/default.gif')}}" style="width:100px;height:100px;"</img> <input type="file" name="logo" value="{{$dernek->logo}}" accept="image/*" > </td>


                                    @endif

                                    </tr>


                                    <tr>
                                        <td> Dernek Adresi: </td>
                                        <td><input type="text" name="dernek_adresi" value="{{$dernek->dernek_adresi}}"></td>
                                        </tr>

                                        <tr>
                                            <td>İl: </td>
                                            <td>
                                                <select id="il_select" name="il">
                                                    @foreach($iller as $il)
                                                    @if($il->id==$dernek->il->id)
                                                    <option value="{{$dernek->il->id}}" selected>{{$dernek->il->adi}}</option>
                                                    @else
                                                    <option value="{{$il->id}}" >{{$il->adi}}</option>
                                                    @endif
                                                    @endforeach


                                                </select>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>İlce:</td>

                                            <td>
                                                <select id="ilce_select" name="ilce">

                                                    @foreach($ilceler as $ilce)
                                                    @if($ilce->id==$dernek->ilce->id)
                                                    <option value="{{$dernek->ilce->id}}" selected>{{$dernek->ilce->adi}}</option>
                                                    @else
                                                    <option value="{{$ilce->id}}" >{{$ilce->adi}}</option>
                                                    @endif
                                                    @endforeach

                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Semt:</td>

                                            <td>
                                                <select id="semt_select" name="semt">
                                                    @foreach($semtler as $semt)
                                                    @if($semt->id==$dernek->semt->id)
                                                    <option value="{{$dernek->semt->id}}" selected>{{$dernek->semt->adi}}</option>
                                                    @else
                                                    <option value="{{$semt->id}}" >{{$semt->adi}}</option>
                                                    @endif
                                                    @endforeach


                                                </select>
                                            </td>


                                        </tr>


                                        <tr>
                                            <td> Telefon Numarası: </td>
                                            <td><input type="text" name="telefon" value="{{$dernek->telefon}}"></td>
                                            </tr>

                                            <tr>
                                                <td> Email: </td>
                                                <td><input type="text" name="email" value="{{$dernek->email}}"></td>
                                                </tr>

                                                <tr>
                                                    <td> İlgili Kisi: </td>
                                                    <td><input type="text" name="ilgili_kisi" value="{{$dernek->ilgili_kisi}}"></td>
                                                    </tr>


                                                    </table> 
                                                    <p></p>
                                                    <button id="sub">Güncelle</button>


                                                    </form>
                                                    </div>

                                                    <span id="result"></span>

                                                    <tr>




                                                        </center>




                                                    <script type=text/javascript">

                                                        $(function() {
                                                        $('#Dernekler').submit(function(){
                                                        alert('now starting submit');
                                                                return true;
                                                        });
                                                                $("#sub").click(function(){
                                                        $('#Dernekler #submit').click();
                                                        });
                                                    </script>

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

                                                                        $('#il_select').change(function (event) {
                                                                //ajax

                                                                var il_id = event.target.value;
                                                                        $.get("{{url('IlinIlceleriniGetir')}}" + "/" + il_id, function (data) { //ajax ile veri çekme (get fonkk.)
                                                                        $('#ilce_select').empty(); //ÖNCE ESKİ İLDEN KALAN İLCELERİ DEĞİŞTİRMEK İÇİN BOŞALTIYORUZ EMPTY DİYEREK.
                                                                                $.each(data, function (index, ilce) {

                                                                                $('#ilce_select').append('<option value="' + ilce.id + '">' + ilce.adi + "</option>");
                                                                                });
                                                                        });
                                                                });
                                                                        $('#ilce_select').change(function (event) { //Kullanıcı ilçeyi değiştirdiği sürece( select id=ilce_select)

                                                                var ilce_id = event.target.value; //event->select değişince değişenelemanı artık ilce_id

                                                                        $.get("{{url('IlceninSemtleriniGetir')}}" + "/" + ilce_id, function (data) { //ilce_id controllerdaki fonksiyonun parametresi
                                                                        // ilce id si ile IlceninSemtleriniGetir route'ına beni yönlendiriyo.
                                                                        $('#semt_select').empty(); //ESKİ İLCEDEN KALAN SEMTLERİ BOŞALTMAK İÇİN
                                                                                $.each(data, function (index, semt) { //her bir değişiklik için
                                                                                $('#semt_select').append('<option value="' + semt.id + '">' + semt.adi + "</option>");
                                                                                        //semt selectini bize artık adını göstererek(semt.adi) göster.

                                                                                });
                                                                        });
                                                                });
                                                                });
                                                    </script>

                                                    </body>
                                                    </html>


