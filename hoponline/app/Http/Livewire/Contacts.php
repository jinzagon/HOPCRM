<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Livewire\WithPagination;
use DB;


class Contacts extends Component
{
    use WithPagination;

    public $q;
    public $confirmingContactDeletion = false;

    public function render()
    {

        $contacts = Contact::join('entreprise', 'entreprise_id', '=', 'entreprise.id')->when($this->q, function ($query) {
            return $query->where(function ($query) {
                $query->where('entreprise.nom', 'like', '%' . $this->q . '%')
                    ->orWhere('prenom', 'like', '%' . $this->q . '%');
            });
        })->selectRaw('entreprise.nom as entreprise_nom, entreprise.statut as entreprise_statut, contact.nom as contact_nom, contact.prenom as contact_prenom, contact.id as id',);





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

}
