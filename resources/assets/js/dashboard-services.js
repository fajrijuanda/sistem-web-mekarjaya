/**
 * Dashboard - Pelayanan Publik
 */

'use strict';
(function () {
  let cardColor, headingColor, labelColor, shadeColor, borderColor;
  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    labelColor = config.colors_dark.textMuted;
    headingColor = config.colors_dark.headingColor;
    borderColor = config.colors_dark.borderColor;
    shadeColor = 'dark';
  } else {
    cardColor = config.colors.cardColor;
    labelColor = config.colors.textMuted;
    headingColor = config.colors.headingColor;
    borderColor = config.colors.borderColor;
    shadeColor = '';
  }

  // Chart untuk Card "Selesai Tepat Waktu"
  // Diambil dari: Link 2 (dashboards-crm.js -> ordersLastWeek)
  // --------------------------------------------------------------------
  const completedOnTimeChartEl = document.querySelector('#completedOnTimeChart'),
    completedOnTimeChartConfig = {
      series: [{ data: [22, 45, 30, 75, 50, 95] }],
      chart: {
        height: 100,
        type: 'line',
        toolbar: { show: false },
        sparkline: { enabled: true }
      },
      grid: { show: false, padding: { top: 10, bottom: 0, left: 0 } },
      colors: [config.colors.success],
      stroke: { width: 3, lineCap: 'round', curve: 'smooth' },
      xaxis: { show: false, lines: { show: false }, labels: { show: false }, axisBorder: { show: false } },
      yaxis: { show: false },
      tooltip: { enabled: false }
    };
  if (typeof completedOnTimeChartEl !== undefined && completedOnTimeChartEl !== null) {
    const completedOnTimeChart = new ApexCharts(completedOnTimeChartEl, completedOnTimeChartConfig);
    completedOnTimeChart.render();
  }

  // Chart untuk Card "Permohonan Ditolak"
  // Diambil dari: Link 2 (dashboards-crm.js -> salesLastYear)
  // --------------------------------------------------------------------
  const rejectedRequestsChartEl = document.querySelector('#rejectedRequestsChart'),
    rejectedRequestsChartConfig = {
      chart: {
        height: 80,
        type: 'area',
        toolbar: { show: false },
        sparkline: { enabled: true }
      },
      markers: { colors: 'transparent', strokeColors: 'transparent' },
      grid: { show: false },
      colors: [config.colors.danger],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.8,
          opacityFrom: 0.6,
          opacityTo: 0.1
        }
      },
      dataLabels: { enabled: false },
      stroke: { width: 2, curve: 'smooth' },
      series: [{ data: [5, 5, 10, 8, 5] }],
      xaxis: { show: false, lines: { show: false }, labels: { show: false }, axisBorder: { show: false } },
      yaxis: { show: false },
      tooltip: { enabled: false }
    };
  if (typeof rejectedRequestsChartEl !== undefined && rejectedRequestsChartEl !== null) {
    const rejectedRequestsChart = new ApexCharts(rejectedRequestsChartEl, rejectedRequestsChartConfig);
    rejectedRequestsChart.render();
  }

  // Grafik "Rata-rata Waktu Proses"
  // Diambil dari: Link 1 (dashboards-analytics.js -> weeklyEarningReports)
  // --------------------------------------------------------------------
  const processingTimeChartEl = document.querySelector('#processingTimeChart'),
    processingTimeChartConfig = {
      chart: {
        height: 255,
        type: 'bar',
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          columnWidth: '40%',
          startingShape: 'rounded',
          endingShape: 'rounded',
          borderRadius: 4,
          distributed: true
        }
      },
      grid: {
        show: true,
        borderColor: borderColor,
        strokeDashArray: 3,
        padding: { top: -20, bottom: -10, left: 0, right: 0 }
      },
      colors: [
        config.colors.primary,
        config.colors.success,
        config.colors.warning,
        config.colors.info,
        config.colors.danger
      ],
      dataLabels: { enabled: false },
      series: [
        {
          name: 'Hari',
          data: [1, 3, 2, 1, 4] // Data: Waktu proses dalam hari
        }
      ],
      legend: { show: false },
      xaxis: {
        categories: ['SKU', 'Surat Pindah', 'SKTM', 'Surat Nikah', 'IMB'],
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: { style: { colors: labelColor, fontSize: '13px' } }
      },
      yaxis: {
        labels: {
          formatter: function (val) {
            return val + ' Hari';
          },
          style: { colors: labelColor, fontSize: '13px' }
        }
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + ' Hari';
          }
        }
      }
    };
  if (typeof processingTimeChartEl !== undefined && processingTimeChartEl !== null) {
    const processingTimeChart = new ApexCharts(processingTimeChartEl, processingTimeChartConfig);
    processingTimeChart.render();
  }

  // Tabel "Semua Permohonan Layanan"
  // Diambil dari: Link 1 (dashboards-analytics.js -> datatables-projects)
  // --------------------------------------------------------------------
  var dt_services_table = $('.datatables-services');
  if (dt_services_table.length) {
    dt_services_table.DataTable({
      ajax: assetsPath + 'json/layanan-terbaru.json', // Pastikan file JSON ini ada
      columns: [
        { data: '' },
        { data: 'id' },
        { data: 'service_name' },
        { data: 'applicant_name' },
        { data: 'date' },
        { data: 'status' },
        { data: 'assignee' },
        { data: '' }
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          searchable: false,
          responsivePriority: 2,
          targets: 0,
          render: () => ''
        },
        {
          targets: 1,
          orderable: false,
          searchable: false,
          responsivePriority: 3,
          checkboxes: { selectAllRender: '<input type="checkbox" class="form-check-input">' },
          render: () => '<input type="checkbox" class="dt-checkboxes form-check-input">'
        },
        {
          targets: 2, // Jenis Layanan
          responsivePriority: 1,
          render: (data, type, full, meta) =>
            '<h6 class="text-truncate mb-0">' + full.service_name + '</h6>' + '<small>' + full.service_type + '</small>'
        },
        {
          targets: 3,
          render: (data, type, full, meta) => '<span class="text-heading">' + full.applicant_name + '</span>'
        },
        { targets: 4, render: (data, type, full, meta) => '<span class="text-heading">' + full.date + '</span>' },
        {
          targets: 5, // Status
          render: function (data, type, full, meta) {
            const status = {
              1: { title: 'Selesai', class: 'bg-label-success' },
              2: { title: 'Diproses', class: 'bg-label-warning' },
              3: { title: 'Ditolak', class: 'bg-label-danger' }
            };
            return '<span class="badge ' + status[full.status].class + '">' + status[full.status].title + '</span>';
          }
        },
        {
          targets: 6,
          render: (data, type, full, meta) => '<span class="text-heading">' + (full.assignee || 'Belum Ada') + '</span>'
        },
        {
          targets: -1, // Aksi
          title: 'Aksi',
          orderable: false,
          searchable: false,
          render: () =>
            '<div class="d-inline-block">' +
            '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-md"></i></a>' +
            '<div class="dropdown-menu dropdown-menu-end m-0">' +
            '<a href="javascript:;" class="dropdown-item">Detail</a>' +
            '<a href="javascript:;" class="dropdown-item">Arsipkan</a>' +
            '</div>' +
            '</div>'
        }
      ],
      order: [[2, 'desc']],
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 10,
      lengthMenu: [10, 25, 50, 100],
      language: {
        search: '',
        searchPlaceholder: 'Cari Permohonan...',
        paginate: {
          next: '<i class="ti ti-chevron-right ti-sm"></i>',
          previous: '<i class="ti ti-chevron-left ti-sm"></i>'
        }
      },
      // Responsiveness
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detail dari ' + data['service_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== ''
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '"><td>' +
                    col.title +
                    ':' +
                    '</td> <td>' +
                    col.data +
                    '</td></tr>'
                : '';
            }).join('');
            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
  }

  // Filter form control to default size
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
})();
