<label for="toggle"  class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-neutral-200 focus:ring-offset-2" role="switch">
    <input type="checkbox" {{$attributes}} class="peer hidden" id="toggle">
    <div class="absolute w-full h-full inset-0 rounded-full bg-danger-500 peer-checked:bg-success-500"></div>
    <span class="translate-x-0 bg-white peer-checked:translate-x-5 pointer-events-none h-5 m-0.5 w-5 rounded-full shadow ring-0 opacity-100 duration-200 peer-checked:opacity-0 peer-checked:duration-100 absolute inset-0 flex items-center justify-center transition" aria-hidden="true">
      <svg class="h-3 w-3 text-danger-500" fill="none" viewBox="0 0 12 12">
        <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </span>
    <span class="translate-x-0 bg-white peer-checked:translate-x-5 pointer-events-none h-5 w-5 m-0.5 rounded-full shadow ring-0 opacity-0 duration-100 peer-checked:opacity-100 peer-checked:duration-200 absolute inset-0 flex items-center justify-center transition" aria-hidden="true">
      <svg class="h-3 w-3 text-success-500" fill="currentColor" viewBox="0 0 12 12">
        <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
      </svg>
    </span>
</label>
