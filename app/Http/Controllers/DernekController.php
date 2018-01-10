<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dernek as Dernek;
use App\Iller as Iller;
use App\Ilceler as Ilceler;
use App\Semt as Semt;
use File;
class DernekController extends Controller {

    //Function to Get Data from Database
    //DATABASEDEN VERİLERİ ÇEKTİĞİM YER BURASI!

    public function DernekEkleSayfasiGoruntule() {

        $iller=Iller::All(); //Databaseden Iller'i çektim.
   
        return view('DernekEkle')->with('iller',$iller);//Çektiğim Iller'i Dernek Ekle sayfasında göster diyorum.
       
    }
    public function IleGoreIlceGonder($il_id){
        
       $ilceler=Ilceler::where('il_id',$il_id)->get();
       return $ilceler;
    }
    
    public function IlceyeGoreSemtGonder($ilce_id){ 
        
      $semtler=Semt::where('ilce_id',$ilce_id)->get(); //Semtler modelinden ilce_id'si $ilce_id olan veriyi getir.
      return $semtler;
        
    }

  
    public function DernekEkle(Request $req) {

        $insert = new Dernek; //benim Dernek adında modelim var ve içinde dernekler tablosunu görüyor. Bu yüzden Dernek objesi yaratarak çağırdım
        $insert->dernek_adi = $req->input('dernek_adi');
        $insert->dernek_adresi = $req->input('dernek_adresi');
        $insert->telefon = $req->input('telefon');
        $insert->email = $req->input('email');
        $insert->ilgili_kisi = $req->input('ilgili_kisi');
        $insert->il_id=$req->input('il');
        $insert->ilce_id=$req->input('ilce');
        $insert->semt_id=$req->input('semt');
        $image= $req->file('logo');
        
        if($image){
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $insert->logo=$filename;
            $image->move("logolar",$filename);
        }
       
        

       $insert->save(); //SAVE DATABASE, oluşturdugum dernegi veri tabanına gönderdim.
        echo 'Kaydedildi';

        return redirect('/DernekListele'); //DernekEkle sayfasına beni yönlendir. BU URL
    }

    public function Listele() {
        $data['data'] =Dernek::All(); //içerisinde dernekler tablosuna ait model var., hepsini getir diyorum.(all())
        if (count($data) > 0) {
            return view('DernekListele', $data); //DernekListele view'ını göster ve bunu döndür.
        } else {
            return view('DernekListele');
        }
        
      
    }
  

    public function store(Request $request) {
        $input = $request->all();

        Dernek::create($input);

        return redirect()->back();
    }

    public function DernekGuncelle(Request $request) {

        $dernek = Dernek::find($request->input('dernek_id')); //DernekGuncelle sayfasındaki formun yolladığı request(istek) id'i old.için 
        //eşittirin sol kısım:dernek tablosundaki dernek adi,2.kısım formdan gelen dernek adi
        $dernek->dernek_adi = $request->get('dernek_adi');
        $dernek->dernek_adresi = $request->get('dernek_adresi');
        $dernek->telefon = $request->get('telefon');
        $dernek->email = $request->get('email');
        $dernek->ilgili_kisi = $request->get('ilgili_kisi');
        $image= $request->file('logo');
        
        if($image){
             File::delete("logolar/".$dernek->logo);
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $dernek->logo=$filename;
            $image->move("logolar",$filename);
           
        }
       
        
        
        $dernek->save();
        return redirect('/DernekListele');

        //return view('/DernekGuncelle',['insert'=>$dernek]);
    }

    public function GuncellemeSayfasiniGoster($id) { //burda Dernek Güncelle sayfasını gösteriyor.
        
      
        
        $dernek = Dernek::find($id); // Dernek Modelinden dernekler tablosunun özelliklerini her birini kendi id'si ile çektim.
        $iller=Iller::All();
        
        $ilceler=Ilceler::where('il_id',$dernek->il->id)->get(); //$dernek'in il id'sini getir.
        $semtler=Semt::where('ilce_id',$dernek->ilce_id)->get();
     
       
        
        return view('DernekGuncelle')->with('id', $id)->with('dernek',$dernek)->with('iller',$iller)->with('ilceler',$ilceler)->with('semtler',$semtler); //çektiğim özellikler dernek güncelleme sayfasına gitti.
    }

    public function DernekSil($id) {

        $dernek = Dernek::find($id);

        $dernek->delete();

        return redirect('/DernekListele');
    }

}
