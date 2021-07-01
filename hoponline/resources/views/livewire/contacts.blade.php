
   
    <div class="pt-2 relative mx-auto text-gray-600">
        <h1 class="text-2xl text-black font-semibold">Liste des contacts</h1>
        <br />
        
        <input wire:model="q" class="mb-4 w-96 border border-b-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Recherche...">
        
        

        <button wire:click="confirmContactAdd" class="float-right bg-cstm hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md inline-flex items-center border border-green-900">
            <svg class="fill-current text-white w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
            </svg>
            <span class="text-white text-sm font-normal">Ajouter</span>
        </button>
       
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="font-bold px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                <button class="font-bold text-left text-xs font-medium text-gray-500 uppercase tracking-wide" wire:click="sortBy('contact_prenom')">Nom du contact</button>
                                </th>
                                <th scope="col" class="font-bold px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                <button class="font-bold text-left text-xs font-medium text-gray-500 uppercase tracking-wide" wire:click="sortBy('entreprise_nom')">Société</button>
                                </th>
                                <th scope="col" class="w-32 font-bold px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                <button class="font-bold text-left text-xs font-medium text-gray-500 uppercase tracking-wide" wire:click="sortBy('entreprise_statut')">Statut</button>
                                </th>

                                <th scope="col" class="w-16 relative px-6 py-3">
                                    <span class="sr-only ">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($contacts as $contact)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">

                                        <div class="">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{$contact->contact_prenom}} {{$contact->contact_nom}} 
                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 font-semibold">{{$contact->entreprise_nom}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                    

                                    @if($contact->entreprise_statut =='lead')         
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize font-bold">
                                    <p style="text-transform: capitalize;">{{$contact->entreprise_statut}}</p>
                                    </span>   
                                    @elseif($contact->entreprise_statut =='prospect') 
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-900 capitalize font-bold ">
                                    <p class=" text-red-400" style="text-transform: capitalize;">{{$contact->entreprise_statut}}</p>
                                    </span>
                                    @elseif($contact->entreprise_statut =='client')   
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <p style="text-transform: capitalize;">{{$contact->entreprise_statut}}</p>
                                    </span>
                                    @endif


                                </td>

                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-end">
                                        <div class="w-4 mr-2 transform text-gray-500 hover:text-black hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform text-gray-500 hover:text-black hover:scale-110">


                                        <span wire:click="confirmContactEdit({{$contact->id}})" wire:loading.attr="disabled">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>

                                        </span>


                                            
                                        </div>
                                        <div class="w-4 mr-2 transform text-red-500 hover:text-red-800 hover:scale-110 cursor-pointer">

                                        <span wire:click="confirmContactDeletion({{$contact->id}})" wire:loading.attr="disabled">
                
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </span>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $contacts->links('pagination::tailwind') }}</div>

                <x-jet-dialog-modal wire:model="confirmingContactDeletion">
            <x-slot name="title">
              
            </x-slot>

            <x-slot name="content">
            <div class="sm:flex sm:items-start">
                <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                  <svg class="h-6 w-6 text-red-600" x-description="Heroicon name: outline/exclamation" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                 </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="text-lg font-bold leading-6 font-medium text-gray-900" id="modal-title">
                    Supprimer le contact
                  </h3>
                  <div class="my-10">
                    <p class="">
                    Etes-vous sûr de vouloir supprimer le contact ?
                    <p/>
                    Cette opération est irreversible. 
                    </p>
                  </div>
                </div>
              </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button class="normal-case" wire:click="$set('confirmingContactDeletion',false)" wire:loading.attr="disabled">
                    {{ __('Annuler') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2 bg-red-500 normal-case" wire:click="deleteContact({{$confirmingContactDeletion}})" wire:loading.attr="disabled">
                    {{ __('Confirmer') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>



        <x-jet-dialog-modal wire:model="confirmingContactAdd">
            <x-slot name="title">
            <h3 class="text-lg font-bold leading-6 font-medium text-gray-900" id="modal-title">
                    Détail du contact
                  </h3>
            </x-slot>

            <x-slot name="content">
             
            <div class="flex mt-6">
        <div class="flex-1 text-left  mr-2"><div class="col-span-6 sm:col-span-4">
            <x-jet-label class="font-bold" for="prenom" value="{{ __('Prénom') }}" />
            <x-jet-input id="prenom" type="text" class="mt-1 block w-full" wire:model.defer="contact.prenom"   />
            <x-jet-input-error for="contact.prenom" class="mt-2" />
        </div></div>


        <div class="flex-1 text-left  ml-2"><div class="col-span-6 sm:col-span-4">
            <x-jet-label class="font-bold" for="nom" value="{{ __('Nom') }}" />
            <x-jet-input id="nom" type="text" class="mt-1 block w-full" wire:model.defer="contact.nom"   />
            <x-jet-input-error for="contact.nom" class="mt-2" />
        </div></div>


            </div>
            <div class="flex-1 text-left mt-4"><div class="col-span-6 sm:col-span-4">
            <x-jet-label class="font-bold" for="e-mail" value="{{ __('E-mail') }}" />
            <x-jet-input id="e-mail" type="text" class="mt-1 block w-full" wire:model.defer="contact.e_mail"  />
            <x-jet-input-error for="contact.e_mail" class="mt-2" />
        </div></div>


        <div class="flex-1 text-left mt-4"><div class="col-span-6 sm:col-span-4">
            <x-jet-label class="font-bold" for="entreprise" value="{{ __('Entreprise') }}" />
            <x-jet-input id="entreprise" type="text" class="mt-1 block w-full" wire:model.defer="entreprise.nom"  />
            <x-jet-input-error for="entreprise.nom" class="mt-2" />
        </div></div>


        <div class="flex-1 text-left mt-4"><div class="col-span-6 sm:col-span-4">
            <x-jet-label class="font-bold" for="adresse" value="{{ __('Adresse') }}" />
            <textarea class="mt-1 block w-full resize border border-gray-300 rounded-md" wire:model.defer="entreprise.adresse"
            rows="3" cols="33">
            It was a dark and stormy night...
            </textarea>            
            <x-jet-input-error for="entreprise.adresse" class="mt-2" />
        </div></div>


        <div class="flex mt-6">
        <div class="flex-shrink text-left  mr-2"><div class="col-span-6 sm:col-span-4">
            <x-jet-label class="font-bold" for="code_postal" value="{{ __('Code postal') }}" />
            <x-jet-input id="code_postal" type="text" class="mt-1 block w-full" wire:model.defer="entreprise.code_postal"   />
            <x-jet-input-error for="entreprise.code_postal" class="mt-2" />
        </div></div>


        <div class="flex-1 text-left  ml-2"><div class="col-span-6 sm:col-span-4">
            <x-jet-label class="font-bold" for="ville" value="{{ __('Ville') }}" />
            <x-jet-input id="ville" type="text" class="mt-1 block w-full" wire:model.defer="entreprise.ville"   />
            <x-jet-input-error for="entreprise.ville" class="mt-2" />
        </div></div>


            </div>
 

            <label id="assigned-to-label" class="block text-sm leading-5 font-bold text-gray-700 mt-4">Statut</label>

            <div class="flex justify-start" wire:ignore wire:model.defer="entreprise.statut"> 
            <select  class="cursor-default relative w-1/2 rounded-md border border-gray-300 bg-white pl-3 pr-10 py-2 text-left focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            <option data-display="Select">Nothing</option>
            <option value="lead">Lead</option>
            <option value="prospect">Prospect</option>
            <option value="client">Client</option>
            </select>

            </div>
    
  
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button class="normal-case" wire:click="$set('confirmingContactAdd',false)" wire:loading.attr="disabled">
                    {{ __('Annuler') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="float-right bg-cstm hover:bg-gray-400 normal-case ml-2 text-white font-bold py-2 px-4 rounded-md inline-flex items-center border border-green-900" wire:click="saveContact()" wire:loading.attr="disabled">
                    {{ __('Valider') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>



            </div>
        </div>
    </div>
    </div>

