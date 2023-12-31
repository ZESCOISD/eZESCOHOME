<?php


namespace App\Http\Livewire\Site;

use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\FAQ;
use App\Models\Product;
use App\Models\ProductClicks;
use App\Models\Slide;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;

class ContactUs extends Component
{

    use WithPagination;

   public $location = 'Great East Road, Stand No.6949 Lusaka, Zambia';
   public $isd_email = 'isd@zesco.co.zm' ;
   public $service_desk_email = 'isd@zesco.co.zm' ;
   public $isd_phone = '2035';
   public $search_term, $nav_search;
    public $search_results = [];
    public $searchQuery;
   public $name;
   public $email;
   public $subject;
   public $message;
   public $successMessage;
   public $receipient ;
   public $selectedProductId;
   public $contactGroups = [];
   public $recipientEmails = [];
   

   protected $paginationTheme = 'bootstrap';


    public function render()
    {

        $products = Product::
        where('status_code', config('constants.status_codes.active'))
            ->orderBy('number_of_clicks', 'desc')
            ->paginate(18) ;

        return view('livewire.site.contact-us', [
            'products' => $products,
        ]);
    }


    public function navSearch(){
        $this->search_results = HomeController::searchResults($this->nav_search);
    }

    public function recordClick($product_id)
    {
        HomeController::recordClick($product_id);
    }


    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required|min:4',
        'message' => 'required',
    ];



    public function submitForm()
    {
        $validatedData = $this->validate();

        // dd( $this->recipientEmails );
        
        $this->recipientEmails[] = 'nshubart@zesco.co.zm';

        Mail::send([], [], function ($message) use ($validatedData) {
            $message->setTo($this->recipientEmails)
                ->setSubject($validatedData['subject'])
                ->setBody($validatedData['message'])
                ->setFrom($validatedData['email']);
        });

        $this->resetForm();
        $this->successMessage = 'Your message has been sent. Thank you!';
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->subject = '';
        $this->message = '';
    }

    public function updatedSelectedProductId($value)
    {
        // Handle the changed value here
        $selectedProduct = Product::with('contactGroups')->find($value);
        // Perform necessary operations with $selectedProduct...
        
        $contactGroups = $selectedProduct->contactGroups ?? null ;
     
        $this->recipientEmails = [];

        if(!empty($contactGroups) ){
            $this->contactGroups = $contactGroups;
            
            foreach ($this->contactGroups as $contactGroup) {
                $this->recipientEmails[] = $contactGroup->email;
            }
        
            $this->receipient = implode(', ', $this->recipientEmails)  ;
        
            if( sizeof($this->recipientEmails) < 1){
                $this->receipient =  $this->isd_email;
                $this->recipientEmails[] = $this->isd_email;
            }
        
        }else{
            if($value == 'isd'){
                $this->receipient  = $this->isd_email ;
                $this->recipientEmails = $this->isd_email;
            }
            elseif($value == 'contact_isd'){
                $this->receipient  = $this->isd_email ;
                $this->recipientEmails = $this->isd_email;
            }elseif($value == 'contact_service_desk'){
                $this->receipient  = $this->service_desk_email ;
                $this->recipientEmails = $this->service_desk_email;
            }else{
                $this->receipient  = $this->ist_email ;
                $this->recipientEmails = $this->isd_email;
            }
        }

        
    }







}
