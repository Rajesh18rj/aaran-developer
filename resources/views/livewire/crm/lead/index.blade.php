<div>
    <x-slot name="header">Leads</x-slot>

    <x-forms.m-panel>

{{--        <x-forms.top-controls :show-filters="$showFilters"/>--}}

        <div class="hidden lg:flex justify-end mb-2">
            <a href="{{ route('enquiries') }}"
               class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500 gap-1 mr-2">
                <x-icons.icon-fill :iconfill="'chevron-d-left'" class="w-5 h-5"></x-icons.icon-fill>
                Back
            </a>
        </div>

        <!-- Card ---------------->

                <div class="max-w-xl h-50 mx-auto rounded-lg border bg-zinc-50 space-y-5 flex-col justify-evenly flex text-sm font-lex p-5 shadow">
                    <div class="flex justify-between text-2xl">
                        <div class="w-full">Contact Name</div>
                        <div wire:model="contactName" class="w-full">{{$enquiry_data->contact_person}}</div>
                    </div>

                    <div  class="flex justify-between">
                        <div class="w-full">Mobile</div>
                        <div wire:model="mobile" class="w-full text-gray-500 ">{{$enquiry_data->vname}}</div>
                    </div>
                </div>

        <!-- Button 1 -> Additional Information-->

        <div class="flex sm:justify-center justify-between">
            <div class="self-end">
                <button wire:click="create"
                    class="tab-button px-6 py-[7px]   relative rounded group overflow-hidden font-medium bg-blue-500 inline-block text-center">
                <span
                    class="absolute top-0 left-0 flex h-full w-0 mr-0 transition-all
                    duration-500 ease-out transform translate-x-0 group-hover:w-full opacity-90
                    bg-blue-600 "></span>
                    <span class="relative group-hover:hidden text-white sm:text-lg text-sm">
               Add Additional Information
            </span>
                    <span
                        class="relative hidden group-hover:block group-hover:text-white sm:px-[7px] px-[3px] sm:py-[2px] py-[0]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="size-6">
                    <path fill-rule="evenodd"
                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                          clip-rule="evenodd"/>
                    </svg>
            </span>
                </button>
            </div>
        </div>



        <div class="flex sm:justify-center justify-between">
            <div class="self-end">
                <button wire:click="addAttempt"
                        class="tab-button px-6 py-[7px]   relative rounded group overflow-hidden font-medium bg-green-500 inline-block text-center">
                <span
                    class="absolute top-0 left-0 flex h-full w-0 mr-0 transition-all
                    duration-500 ease-out transform translate-x-0 group-hover:w-full opacity-90
                    bg-green-600 "></span>
                    <span class="relative group-hover:hidden text-white sm:text-lg text-sm">
               Add Attempt
            </span>
                    <span
                        class="relative hidden group-hover:block group-hover:text-white sm:px-[7px] px-[3px] sm:py-[2px] py-[0]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="size-6">
                    <path fill-rule="evenodd"
                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                          clip-rule="evenodd"/>
                    </svg>
            </span>
                </button>
            </div>
        </div>

        <div class="text-blue-500">Additional Information</div>
        <!-- Table Header  ------------------------------------------------------------------------------------------>
        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">



                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Title</x-table.header-text>
                <x-table.header-text sort-icon="none">Lead By</x-table.header-text>
                <x-table.header-text sort-icon="none">Description</x-table.header-text>
{{--                <x-table.header-text sort-icon="none">Assigned To</x-table.header-text>--}}
                <x-table.header-text sort-icon="none">Software Type</x-table.header-text>
                <x-table.header-text sort-icon="none">Questions</x-table.header-text>
{{--                <x-table.header-text sort-icon="none">Status</x-table.header-text>--}}
                <x-table.header-text sort-icon="none">Verified By</x-table.header-text>

                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

{{--                    @dd($list)--}}

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>

{{--                        @dd($row->id)--}}

                        <x-table.cell-text>
                            <a href="{{route('followups', $row->id)}}">{{$row->vname}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$row->lead->name}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <div class="line-clamp-1">
                                {!! $row->body !!}
                            </div>
                        </x-table.cell-text>


                        <x-table.cell-text>
                            {{$row->softwareType->vname}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$row->questions}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$row->verifiedBy->name}}
                        </x-table.cell-text>


                        {{--                        <x-table.cell-text class="{{App\Enums\Status::tryFrom($row->status_id)->getStyle()}}" center>--}}
{{--                            {{App\Enums\Status::tryFrom($row->status_id)->getName()}}--}}
{{--                        </x-table.cell-text>--}}


{{--                        <x-table.cell-action id="{{$row->id}}"/>--}}

                        <td>
                            <div class="flex justify-center items-center sm:gap-4 gap-2 px-1 self-center">
                                <a href="{{route('leads.upsert',[$row->id])}}" class="pt-1">
                                    <x-button.edit/>
                                </a>
                                <x-button.delete wire:click="getDelete({{$row->id}})"/>

                            </div>
                        </td>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>
        <x-modal.delete/>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <!--Add Attempt Modal-->
        <form wire:submit.prevent="addAttempt">
            <div class="w-full h-auto">
                <x-jet.modal wire:model.defer="showAttemptModal" >

                    <div class="sm:px-6 px-2 pt-4">
                        <div class="text-lg">
                            Attempt Entry
                        </div>
                        <x-forms.section-border class="py-2"/>
                        <div class="mt-4">

                            <div class="space-y-4">

                                <div>
                                    <x-input.floating wire:model="common.vname" :label="'Attempt No:'"/>
                                    @error('common.vname')
                                    <div class="text-xs text-red-500">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <x-input.model-select wire:model="assignee_name" :label="'Lead By'">
                                    <option value="">Choose...</option>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </x-input.model-select>
                            </div>

                            <div class="mt-3">
                                <x-input.rich-text :placeholder="'Description'" wire:model="body"/>
                                @error('body')
                                <div class="text-xs text-red-500">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <x-input.model-select wire:model="status_id" :label="'Status'">
                                    <option value="">Choose...</option>
                                    @foreach(App\Enums\Status::cases() as $status)
                                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                                    @endforeach
                                </x-input.model-select>
                            </div>

                            <div class="mt-3">
                                <x-input.model-select wire:model="verified_by" :label="'Verified By'">
                                    <option value="">Choose...</option>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </x-input.model-select>
                            </div>


                        </div>
                        <div class="mb-1">&nbsp;</div>
                    </div>

                    <div class="sm:px-6 px-3 py-3 bg-gray-100 text-right">
                        <div class="w-full flex justify-between gap-3">
                            <div class="py-2">
                                <label for="common.active_id" class="inline-flex relative items-center cursor-pointer">
                                    <input type="checkbox" id="common.active_id" class="sr-only peer"
                                           wire:model="common.active_id">
                                    <div
                                        class="w-10 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2
                                        peer-focus:ring-blue-300
                                         peer-checked:after:translate-x-full peer-checked:after:border-white
                                         after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300
                                         after:border after:rounded-full after:h-4 after:w-4 after:transition-all
                                         peer-checked:bg-blue-600"></div>
                                    <span class="ml-3 sm:text-sm text-xs font-medium text-gray-900">Active</span>
                                </label>
                            </div>
                            <div class="flex gap-3">
{{--                                                        <x-button.cancel/>--}}
                                <x-button.cancel-x wire:click.prevent="$set('showAttemptModal', false)" />
{{--                                                        <x-button.save/>--}}
                                <x-button.save-x  wire:click.prevent="save" />
                            </div>
                        </div>
                    </div>


                </x-jet.modal>
            </div>

        </form>

    </x-forms.m-panel>
</div>
