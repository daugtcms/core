<div class="py-1 w-full mx-auto flex items-start gap-x-3" id="comments">
    <x-daugt::avatar :user="auth()->user()" class="w-13 h-13 mt-1.5 ml-1.5 flex-shrink-0"></x-daugt::avatar>
    <form method="POST" action="{{route('daugt.member-area.course.comments.create', ['course' => $course, 'section' => $section])}}" class="flex-1" enctype='multipart/form-data'
        x-data="{
                    images: [],
                    submitDisabled: false,
                    removeImage(image) {
                        const list = new DataTransfer();
                        for (let index = 0; index < this.images.length; index++) {
                            if (this.images[index] !== image) {
                                list.items.add(this.images[index]);
                            }
                        }
                        this.images = list.files;
                    },
                    create($event) {
                        $event.preventDefault();
                        if (this.images.length > 0) {
                            this.$refs.fileUpload.files = this.images;
                        }
                        $event.target.submit();
                        this.submitDisabled = true;
                    },
                    chooseImages($event) {
                        const files = $event.target.files;
                        let tooLarge = false;
                        for (let index = 0; index < files.length; index++) {
                            if (files[index].size > 10 * 1024 * 1024) {
                                tooLarge = true
                            }
                        }
                        if (tooLarge || $event.target.files.length > 5) {
                            alert('Bitte maximal 5 Bilder mit je maximal 10MB hochladen!');
                        } else {
                            this.images = $event.target.files;
                        }
                    }
                }
                                       ">
        @csrf
        <x-daugt::content.comment-textbox class="z-10 relative"></x-daugt::content.comment-textbox>
        <div class="bg-neutral-50 rounded-md pt-3.5 -mt-2 mx-0.5 pb-2 px-2 text-neutral-600">
            <div x-show="images.length > 0">
                <ul role="list" class="grid grid-cols-3 gap-4 pb-4 pt-2 sm:grid-cols-6">
                    <template x-for="image in images">
                        <li class="relative">
                            <div
                                    class="relative w-full overflow-hidden bg-white shadow flex rounded-lg group aspect-square">
                                <img :src="URL.createObjectURL(image)" alt=""
                                     class="object-cover pointer-events-none items-center justify-center w-full h-full">
                                <div
                                        class="z-10 absolute inset-0 flex items-center justify-center w-full h-full bg-black opacity-0 bg-opacity-30 group-hover:opacity-100">
                                    <div class="i-lucide:trash w-8 h-8 text-white cursor-pointer"
                                         x-on:click="removeImage(image)"/>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
            <div class="flex justify-between items-center">
                <label>
                    <x-daugt::form.button style="light" type="button" x-on:click="$refs.fileupload.click()">
                        <div class="i-lucide:image" class="w-5 mr-0.5"></div>
                        {{__('daugt::content.add_images')}}
                    </x-daugt::form.button>
                    <input multiple x-ref="fileupload" x-on:input="chooseImages($event)"
                           accept="image/jpeg, image/gif, image/png" type="file"
                           name="fileupload[]"
                           id="fileupload" class="hidden">
                </label>
                <label class="inline-flex items-center gap-x-2">
                    <span>{{__('daugt::content.post_anonymously')}}</span>
                    <x-daugt::form.toggle name="anonymous"></x-daugt::form.toggle>
                </label>
            </div>
        </div>

    </form>
</div>