/**
 * Dashboard - Konten & Website
 */

'use strict';
(function () {
  let labelColor, headingColor, borderColor;
  if (isDarkStyle) {
    labelColor = config.colors_dark.textMuted;
    headingColor = config.colors_dark.headingColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    labelColor = config.colors.textMuted;
    headingColor = config.colors.headingColor;
    borderColor = config.colors.borderColor;
  }

  // Grafik Sumber Pengunjung
  // Diambil dari: Link 5 (app-academy-dashboard.js -> leadsReportChart)
  // --------------------------------------------------------------------
  const trafficSourceChartEl = document.querySelector('#trafficSourceChart'),
    trafficSourceChartConfig = {
      chart: {
        height: 170,
        width: 150,
        parentHeightOffset: 0,
        type: 'donut'
      },
      labels: ['Google', 'Facebook', 'Direct', 'Lainnya'],
      series: [45, 25, 20, 10], // Persentase data
      colors: [config.colors.primary, config.colors.info, config.colors.success, config.colors.secondary],
      stroke: { width: 0 },
      dataLabels: { enabled: false },
      legend: { show: false },
      tooltip: { theme: false },
      grid: { padding: { top: 0 } },
      plotOptions: {
        pie: {
          donut: {
            size: '70%',
            labels: {
              show: true,
              value: {
                fontSize: '1.125rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                fontWeight: 500,
                offsetY: -20,
                formatter: val => parseInt(val) + '%'
              },
              name: { offsetY: 20, fontFamily: 'Public Sans' },
              total: {
                show: true,
                fontSize: '.9375rem',
                label: 'Total',
                color: labelColor,
                formatter: w => '15.2k'
              }
            }
          }
        }
      }
    };
  if (typeof trafficSourceChartEl !== 'undefined' && trafficSourceChartEl !== null) {
    const trafficSourceChart = new ApexCharts(trafficSourceChartEl, trafficSourceChartConfig);
    trafficSourceChart.render();
  }

  // Grafik Kategori Paling Populer
  // Diambil dari: Link 5 (app-academy-dashboard.js -> horizontalBarChart)
  // --------------------------------------------------------------------
  const popularCategoriesChartEl = document.querySelector('#popularCategoriesChart'),
    popularCategoriesChartConfig = {
      chart: {
        height: 320,
        type: 'bar',
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          horizontal: true,
          barHeight: '70%',
          distributed: true,
          startingShape: 'rounded',
          borderRadius: 7
        }
      },
      grid: {
        strokeDashArray: 10,
        borderColor: borderColor,
        xaxis: { lines: { show: true } },
        yaxis: { lines: { show: false } },
        padding: { top: -35, bottom: -12 }
      },
      colors: [
        config.colors.primary,
        config.colors.info,
        config.colors.success,
        config.colors.secondary,
        config.colors.danger
      ],
      dataLabels: {
        enabled: true,
        style: {
          colors: ['#fff'],
          fontWeight: 500,
          fontSize: '13px',
          fontFamily: 'Public Sans'
        },
        formatter: (val, opts) => popularCategoriesChartConfig.labels[opts.dataPointIndex],
        offsetX: 0,
        dropShadow: { enabled: false }
      },
      labels: ['Berita Desa', 'Pengumuman', 'UMKM', 'Kesehatan', 'Kegiatan'],
      series: [
        {
          data: [42, 35, 22, 18, 11] // Data dalam persentase atau jumlah pembaca
        }
      ],
      xaxis: {
        categories: ['42%', '35%', '22%', '18%', '11%'],
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          },
          formatter: val => `${val}`
        }
      },
      yaxis: {
        max: 45,
        labels: {
          style: {
            colors: [labelColor],
            fontFamily: 'Public Sans',
            fontSize: '13px'
          }
        }
      },
      tooltip: {
        enabled: true,
        style: { fontSize: '12px' },
        onDatasetHover: { highlightDataSeries: false },
        custom: ({ series, seriesIndex, dataPointIndex, w }) =>
          '<div class="px-3 py-2"><span>' + series[seriesIndex][dataPointIndex] + ' Dilihat</span></div>'
      },
      legend: { show: false }
    };
  if (typeof popularCategoriesChartEl !== 'undefined' && popularCategoriesChartEl !== null) {
    const popularCategoriesChart = new ApexCharts(popularCategoriesChartEl, popularCategoriesChartConfig);
    popularCategoriesChart.render();
  }
})();