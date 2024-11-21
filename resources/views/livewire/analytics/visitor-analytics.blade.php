<div>
<x-daugt::layouts.dashboard-bar>
    <div class="inline-flex items-center gap-x-2">
        <h1 class="text-lg font-medium text-neutral-800">{{__('daugt::analytics.title')}}</h1>
    </div>
</x-daugt::layouts.dashboard-bar>
    <div class="max-w-7xl mx-auto p-3 flex flex-col h-full">
    <x-daugt::charts.apexcharts options="
    {
      series: [

        {
          name: '{{__('daugt::analytics.page_views')}}',
          data: {{json_encode($views)}}
        },
      {
          name: '{{__('daugt::analytics.visitors')}}',
          data: {{json_encode($visitors)}},
        }
        ],
        chart: {
          id: 'area-datetime',
          type: 'area',
          height: 350,
          zoom: {
            enabled: false,
            autoScaleYaxis: true
          },
          toolbar: {
            show: false
          },
          fontFamily: 'system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji'
        },
        dataLabels: {
        enabled: false
        },
        markers: {
        size: 0,
        style: 'hollow',
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
            type: 'datetime',
            // min: new Date('01 Mar 2012').getTime(),
            tickAmount: 6,
            tooltip: {
                enabled: false
            }
        },
        yaxis: {
            tooltip: {
                enabled: false
            }
        },
        tooltip: {
        x: {
        format: 'dd MMM yyyy HH:mm'
        }
        },
        fill: {
        colors: ['#34d399', '#94a3b8'],
        type: 'gradient',
        gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.9,
        stops: [0, 100]
        }
        },
        }
    ">

    </x-daugt::charts.apexcharts>
    <div class="w-screen-sm max-w-full mx-auto">
        <h2 class="text-xl font-medium border-b-2 w-full pb-1 mb-4 mt-8">{{__('daugt::analytics.top_x_pages', ['count' => 25])}}</h2>
        <ul role="list" class="divide-y divide-gray-100">
            @foreach($viewsList as $view)
            <li class="flex justify-between gap-x-6 py-4">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        @switch(class_basename($view->eventable))
                            @case('Content')
                                <p class="text-sm/6 font-semibold text-gray-900">{{$view->eventable->title}} @empty($view->eventable->title)<div class="i-lucide-home w-5 h-5"></div>@endempty</p>
                                <p class="mt-1 truncate text-xs/5 text-gray-500">{{Str::ucfirst($view->eventable->type)}}</p>
                                @break
                            @case('Product')
                                <p class="text-sm/6 font-semibold text-gray-900">{{$view->eventable->name}}</p>
                                <p class="mt-1 truncate text-xs/5 text-gray-500">{{__('daugt::analytics.shop_product')}}</p>
                                @break
                        @endswitch
                    </div>
                </div>
                <div class="flex shrink-0 flex-col items-end justify-center">
                    <p class="text-lg/4 bg-emerald-100 rounded px-1 py-0.5 text-emerald-600">{{$view->views}}</p>
                    <p class="mt-1 text-xs/5 text-gray-500">{{Number::percentage($view->percentage * 100)}}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    </div>
</div>