@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-5 mb-8">
    @foreach([
        ['label'=>'New Leads',     'value'=>$stats['leads_new'],   'color'=>'bg-blue-50 text-blue-700',   'border'=>'border-blue-200'],
        ['label'=>'Leads (Week)',  'value'=>$stats['leads_week'],  'color'=>'bg-indigo-50 text-indigo-700','border'=>'border-indigo-200'],
        ['label'=>'Leads (Month)','value'=>$stats['leads_month'], 'color'=>'bg-violet-50 text-violet-700','border'=>'border-violet-200'],
        ['label'=>'Blog Posts',   'value'=>$stats['blogs_total'], 'color'=>'bg-emerald-50 text-emerald-700','border'=>'border-emerald-200'],
        ['label'=>'Case Studies', 'value'=>$stats['case_studies'],'color'=>'bg-amber-50 text-amber-700',  'border'=>'border-amber-200'],
        ['label'=>'Services',     'value'=>$stats['services'],    'color'=>'bg-rose-50 text-rose-700',    'border'=>'border-rose-200'],
    ] as $stat)
    <div class="bg-white rounded-xl border {{ $stat['border'] }} p-5">
        <p class="text-xs font-medium text-gray-500 mb-1">{{ $stat['label'] }}</p>
        <p class="text-3xl font-heading font-bold {{ $stat['color'] }} rounded-lg inline-block px-2 py-0.5">{{ $stat['value'] }}</p>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Lead Chart --}}
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="font-semibold text-gray-800 mb-5">Leads — Last 30 Days</h2>
        <canvas id="leadChart" height="120"></canvas>
    </div>

    {{-- Latest Leads --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-semibold text-gray-800">Latest Leads</h2>
            <a href="{{ route('admin.leads.index') }}" class="text-xs text-teal-600 hover:underline">View all</a>
        </div>
        <div class="space-y-4">
            @foreach($latestLeads as $lead)
            <a href="{{ route('admin.leads.show', $lead->id) }}" class="flex items-start gap-3 group">
                <div class="w-9 h-9 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm shrink-0">
                    {{ strtoupper(substr($lead->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 group-hover:text-primary-700 truncate">{{ $lead->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ $lead->email }}</p>
                </div>
                <div class="shrink-0 text-right">
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $lead->status === 'new' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600' }}">{{ $lead->status }}</span>
                    <p class="text-xs text-gray-400 mt-1">{{ $lead->created_at->diffForHumans() }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const chartData = @json($chartData);
const labels = [];
const values = [];
const today = new Date();
for (let i = 29; i >= 0; i--) {
    const d = new Date(today);
    d.setDate(d.getDate() - i);
    const key = d.toISOString().split('T')[0];
    labels.push(d.toLocaleDateString('en-US', {month:'short', day:'numeric'}));
    values.push(chartData[key] || 0);
}
new Chart(document.getElementById('leadChart'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Leads',
            data: values,
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.08)',
            fill: true,
            tension: 0.4,
            pointRadius: 3,
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
        responsive: true,
    }
});
</script>
@endpush
