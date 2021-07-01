<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Entreprise;
use Livewire\WithPagination;
use DB;
use Illuminate\Support\Str;


class Contacts extends Component
{
    use WithPagination;

    public $q;
    public $contact;
    public $entreprise;
    public $sortBy = 'id';
    public $sortAsc = true;

    protected $queryString = [
        'q' => ['except'=> ''],
        'sortBy' => ['except'=> 'id'],
        'sortAsc' => ['except'=> true],
    ];


    public $confirmingContactDeletion = false;
    public $confirmingContactAdd = false;

    protected $rules = [
        'contact.nom' => 'required|string|alpha',
        'contact.prenom' => 'required|string|alpha',
        'contact.e_mail' => 'required|email',        
        'entreprise.nom' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
        'entreprise.code_postal' => 'numeric',
        'entreprise.adresse' => 'string',
        'entreprise.ville' => 'string',
        'entreprise.statut' => 'string',
    ];

    public function render()
    {

        $contacts = Contact::join('entreprise', 'entreprise_id', '=', 'entreprise.id')->when($this->q, function ($query) {
            return $query->where(function ($query) {
                $query->where('entreprise.nom', 'like', '%' . $this->q . '%')
                    ->orWhere('prenom', 'like', '%' . $this->q . '%');
            });
        })->selectRaw('entreprise.nom as entreprise_nom, entreprise.statut as entreprise_statut, contact.nom as contact_nom, contact.prenom as contact_prenom, contact.id as id')
        ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');


        $query = $contacts->toSql();
        $contacts = $contacts->paginate(10);


        return view('livewire.contacts', [
            'contacts' => $contacts,
            'query' => $query
        ]);
    }

    public function confirmContactDeletion($id){
        //$contact->delete();
        $this->confirmingContactDeletion = $id;
    }

    public function deleteContact(Contact $contact)
    {
        $contact->delete();
        $this->confirmingContactDeletion = false ;
    }

    public function confirmContactAdd(){
        //$contact->delete();
        $this->reset(['contact']);
        $this->confirmingContactAdd = true;
    }

    
    public function confirmContactEdit(Contact $contact, Entreprise $entreprise){        
        $this->contact = $contact;
        $this->entreprise = $entreprise;
        $this->confirmingContactAdd = true;
    }

    public function sortBy($field){
        if ($field == $this->sortBy){$this->sortAsc = !$this->sortAsc;}
        $this->sortBy = $field;
    }

    public function saveContact()
    {
        $this->validate();

        $newentreprise = Entreprise::create([            
            'nom' => ucwords(strtolower($this->entreprise['nom'])),
            'adresse' => $this->entreprise['adresse'] ?? null,
            'cle' => Str::random(32),
            'code_postal' => $this->entreprise['code_postal'],
            'ville' => ucwords(strtolower($this->entreprise['ville'])),
            'statut' => $this->entreprise['statut'],
        ]);


        if( isset ($this->contact->id)){
            $this->contact->save();
        } else {        
        Contact::create([
            'nom' => ucwords(strtolower($this->contact['nom'])),
            'prenom' => ucwords(strtolower($this->contact['prenom'])),
            'e_mail' => strtolower($this->contact['e_mail']), 
            'cle' => Str::random(32), 
            'telephone_mobile' => '',
            'telephone_fixe' => '',
            'entreprise_id' => $newentreprise->id,
        ]);
    }
    

        $this->confirmingContactAdd = false ;

    }

}
