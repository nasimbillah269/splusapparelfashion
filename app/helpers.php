<?php

use App\Models\General;
use App\Models\Media;
use App\Models\Country;
use App\Models\Post;
use App\Models\PostExtra;
use App\Models\Attribute;
use Carbon\Carbon;


function general(){
  return $general =General::first();
}

function websiteTitle($title=null){
  
  $hasTitle =$title?' - ':'';
  $text =general()->title;
  $text1=general()->subtitle;
  $text2=$text&&$text1?' - ':'';
  return $title.$hasTitle.$text.$text2.$text1;
}

function isMobileDevice() {
  return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo 
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i" 
, $_SERVER["HTTP_USER_AGENT"]); 
}

function adminTheme(){
  $theme=general()->adminTheme.'.';
  if(isMobileDevice()){
    $theme=general()->adminTheme.'.';
  }
  return $theme;
}

function welcomeTheme(){
  $theme=general()->theme.'.';
  if(isMobileDevice()){
    $theme=general()->theme.'.';
  }
  return $theme;
}

function assetLink(){
  return general()->theme;
}

function assetLinkAdmin(){
  return general()->adminTheme;
}

// Old records were saved as "public/medies/..."; strip the prefix so paths work with asset() and public_path()
function cleanPublicPath($path){
  if(is_string($path) && str_starts_with($path,'public/')){
    return substr($path,7);
  }
  return $path;
}

function geoData($type=null,$parent=null,$id=null){

  $data =Country::orderBy('name')->select(['id','type','parent_id','name']);
  if($type){
    $data =$data->where('type',$type);
  }

  if($parent){
    $data =$data->where('parent_id',$parent);
  }

  if($id){
    $data =$data->find($id);
  }else{
    $data =$data->get();
  }
  
  return $data;
}

function bn2enNumber ($number){
  $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
  $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
  $en_number = str_replace($search_array, $replace_array, $number);

  return $en_number;
}

function en2bnNumber ($number){
  $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
  $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
  $en_number = str_replace($search_array, $replace_array, $number);

  return $en_number;
}

function en2bnMonth($month){
  $search_array= array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October","November","December","Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct","Nov","Dec","01", "02", "03", "04", "05", "06", "07", "08", "09", "10","11","12");
  $replace_array= array("জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর","জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর","জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর");
  $en_number = str_replace($search_array, $replace_array, $month);
  return $en_number;
}

function priceFormat($amount=0)
{
  $formatAmount ='';

  $formatAmount = number_format($amount,0);

  return $formatAmount;

}


function priceFullFormat($amount=0)
{
  $formatAmount ='';

  $amountFormet = number_format($amount,0);
  
  $formatAmount = general()->currency.' '.$amountFormet;
 
  return $formatAmount;

}

function sendMail($toEmail,$toName,$subject,$datas,$template,$attachments=null){
    
  try {
    Mail::send($template,compact('datas'), function ($message) use ($toEmail,$toName,$subject,$attachments) {
        $message->from(general()->mail_from_address, general()->mail_from_name);
        $message->to($toEmail,$toName);
        //To bb mail 
        //$message->cc($ccRecipients);
        //To Replay diffrent mail 
        //$message->replyTo('replyto@example.com', 'Reply To Name');
        
        $message->subject($subject);
        
        if($attachments){
            // Attachments
            foreach ($attachments as $attachment) {
                $message->attach($attachment['path'], [
                    'as' => $attachment['name'],
                    'mime' => $attachment['mime'],
                ]);
            }
        }
        
    });
      return true;
  } catch (\Throwable $ex) {
      \Log::error('sendMail failed: '.$ex->getMessage());
      return false;
  }

}

function sendSMS($to,$msg){
  $userId = general()->sms_username;
  $pass = general()->sms_password;
  $masking = general()->sms_senderid;
  if(general()->sms_type=='Non Masking'){
  $url =general()->sms_url_nonmasking; 
  return "{$url}?username={$userId}&password={$pass}&number={$to}&message={$msg}";
  }else{
  $url =general()->sms_url_masking;
  return "{$url}?username={$userId}&password={$pass}&number={$to}&message={$msg}&senderid={$masking}";
  }
}

function slider($location=null){
  return Attribute::latest()->where('type',1)->where('status','active')->where('location',$location)->first();
}

function menu($location=null){
  return Attribute::latest()->where('type',8)->where('status','active')->where('location',$location)->first();
}

function page($id=null){
  return Post::where('type',0)->find($id);
}

function pageTemplate($template=null){
  return Post::where('type',0)->where('template',$template)->first();
}

// Link to the page that uses a template (e.g. "Contact Us"), so links keep working when its slug is changed in Admin
function templateUrl($template, $fallback=null){
  static $cache = [];
  if(!array_key_exists($template, $cache)){
    $cache[$template] = Post::where('type',0)->where('template',$template)->where('status','active')->value('slug');
  }
  return $cache[$template] ? route('pageView',$cache[$template]) : ($fallback ?: route('index'));
}

function uploadFile($file,$src,$srcType,$fileUse,$author=null,$fileStatus=true){


  if($fileStatus){
      $media = Media::where('src_type',$srcType)->where('use_Of_file',$fileUse)->where('src_id',$src)->first();
  }else{
      $media = null;
  }

  if(!$media){
    $media =new Media();
    }else{
      if(File::exists($media->file_url)){
            File::delete($media->file_url);
        }
        if(File::exists($media->file_url_sm)){
            File::delete($media->file_url_sm);
        }
        if(File::exists($media->file_url_md)){
            File::delete($media->file_url_md);
        }
        if(File::exists($media->file_url_lg)){
            File::delete($media->file_url_lg);
        }
    }
    
    $name = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
    $fullname = basename($file->getClientOriginalName());
    $ext =$file->getClientOriginalExtension();
    $size =$file->getSize();
    $mimeType =null; // $file->getMimeType();

    $year =carbon::now()->format('Y');
    $month =carbon::now()->format('M');
    $folder = $month.'_'.$year;

    $img =time().'.'.uniqid().'.'.$file->getClientOriginalExtension();
    $path ="medies/".$folder;
    $fullpath ="medies/".$folder.'/'.$img;
    $media->src_type=$srcType;
    $media->use_Of_file=$fileUse;
    $media->src_id=$src;
    $media->file_name=Str::limit($fullname,250);
    $media->alt_text=Str::limit($name,250);
    $media->file_rename=Str::limit($img,100);
    $media->file_size=$size;
    $media->mine_type=$mimeType;
    if($ext=='png' || $ext=='jpeg' || $ext=='svg' || $ext=='gif' || $ext=='jpg' || $ext=='webp'){
      $media->file_type=1;
      }elseif($ext=='pdf'){
      $media->file_type=2;
      }elseif($ext=='docx'){
      $media->file_type=3;
      }elseif($ext=='zip' || $ext=='rar'){
      $media->file_type=4;
      }elseif($ext=='mp4' || $ext=='webm' || $ext=='mov' || $ext=='wmv'){
      $media->file_type=5;
      }elseif($ext=='mp3'){
      $media->file_type=6;
    }
    $file->move(public_path($path), $img);
    $media->file_url =$fullpath;
    $media->file_path =$path;
    $media->addedby_id=$author;
    $media->save();

    return $media;

}

// Projects (Admin > Projects, stored as posts type 2) prepared for the website cards.
// Featured projects come first when $featuredFirst is true. Falls back to sample cards when none exist.
function projectCards($limit=null, $featuredFirst=false){
  $query = Post::where('type',2)->where('status','active')->whereDate('created_at','<=',Carbon::now());
  if($featuredFirst){
    $query->orderBy('fetured','desc');
  }
  $query->latest();
  if($limit){
    $query->limit($limit);
  }

  $cards = $query->get(['id','name','short_description','tags','fetured','created_at'])->map(function($p){
    $words = preg_split('/\s+/', trim((string) $p->name));
    $half = (int) ceil(count($words) / 2);
    $ctg = $p->productCategories->first();
    return [
      'line1' => implode(' ', array_slice($words, 0, $half)),
      'line2' => implode(' ', array_slice($words, $half)),
      'name'  => $p->name,
      'cat'   => $ctg ? $ctg->name : '',
      'text'  => Str::limit(trim(strip_tags((string) $p->short_description)), 140),
      'image' => $p->imageFile ? asset($p->image()) : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=900&h=620&q=75',
      'link'  => $p->tags,
    ];
  });

  if($cards->isEmpty()){
    $text = "Accelerate innovation with world-class tech teams We'll match you to an entire remote team of incredible freelance talent for all your";
    $cards = collect([
      ['photo-1498050108023-c5249f4df085','Web Development','Custom Web','Application'],
      ['photo-1497366216548-37526070297c','Cloud Service','Cloud','Infrastructure'],
      ['photo-1531482615713-2afd69097998','Software','Business','ERP Software'],
      ['photo-1556761175-b413da4baf72','IT Consulting','Business','Consultancy'],
    ])->map(fn($c) => [
      'line1' => $c[2], 'line2' => $c[3], 'name' => $c[2].' '.$c[3], 'cat' => $c[1], 'text' => $text,
      'image' => 'https://images.unsplash.com/'.$c[0].'?auto=format&fit=crop&w=900&h=620&q=75', 'link' => null,
    ]);
  }

  return $cards;
}

// Testimonials (Admin > Testimonials, stored as client attributes type 3) prepared for the home slider.
// Featured first, then newest. Falls back to sample testimonials when none exist.
function testimonialCards($limit=12){
  $cards = Attribute::where('type',3)->where('status','active')
    ->orderBy('fetured','desc')->latest()->limit($limit)
    ->get(['id','name','short_description','description','fetured','created_at'])
    ->map(function($c){
      $words = preg_split('/\s+/', trim((string) $c->name));
      $initials = strtoupper(mb_substr($words[0] ?? '', 0, 1).(count($words) > 1 ? mb_substr(end($words), 0, 1) : ''));
      return [
        'name'     => $c->name,
        'role'     => $c->short_description,
        'text'     => Str::limit(trim(strip_tags((string) $c->description)), 220),
        'image'    => $c->imageFile ? asset($c->image()) : null,
        'initials' => $initials,
      ];
    })
    ->filter(fn($c) => $c['name'] && $c['text'])
    ->values();

  if($cards->isEmpty()){
    $cards = collect([
      ['photo-1500648767791-00dcc994a43e','Accelerate innovation with world-class tech teams Beyond more stoic this along goodness hey this this wow manatee.','James Smith','CFO Apple Corp'],
      ['photo-1506794778202-cad84cf45f1d','I believe in lifelong learning and they are a great place to learn from experts. I have learned a lot and recommend it.','Monica Blews','Manager'],
      ['photo-1534528741775-53994a69daeb','Their team delivered our platform ahead of schedule with outstanding quality. Communication was clear from day one.','Sarah Lee','Product Owner'],
      ['photo-1472099645785-5658abf4ff4e','Professional, responsive and highly skilled. They understood our business and turned it into a great product.','David Miller','CEO Nexa Ltd'],
    ])->map(fn($t) => [
      'name' => $t[2], 'role' => $t[3], 'text' => $t[1], 'initials' => '',
      'image' => 'https://images.unsplash.com/'.$t[0].'?auto=format&fit=crop&w=400&h=400&q=75',
    ]);
  }

  return $cards;
}

// Service detail FAQs: JSON in posts.tags ([{q,a}]). Never saved yet -> default FAQs; saved empty -> none.
function serviceFaqs($service){
  if($service->tags === null || $service->tags === ''){
    return [
      ['q'=>'How long does it take to finish a project?','a'=>'Timelines depend on scope. Most projects are delivered in a few weeks; we share a clear schedule and milestones before we start.'],
      ['q'=>'Support & Policy rules?','a'=>'Every project includes post-launch support. We fix bugs quickly and offer ongoing maintenance plans for updates and improvements.'],
      ['q'=>'Can we get a refund?','a'=>'Payments are split into milestones. If we cannot deliver an agreed milestone, the payment for that milestone is refunded.'],
    ];
  }
  $faqs = json_decode($service->tags, true);
  return is_array($faqs) ? array_values(array_filter($faqs, fn($f) => !empty($f['q']))) : [];
}
