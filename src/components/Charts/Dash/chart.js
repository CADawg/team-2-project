export const dollaChart = {
    type: 'line',
    data: {
      labels: ['1st quarter ', '2nd quarter ', '3rd quarter ', '4th quarter'],
      datasets: [
        { // one line graph
          label: 'Employee satisfaction',
          data: [5, 13, 17, ],
          backgroundColor: [
            'transparent'
          ],
          borderColor: [
            '#A7A7FF',
          ],
          borderWidth: 3
        }
      ]
    },
    options: {
      responsive: true,
      legend: {
          labels: {
            fontColor: '#EEE5E9'
          }
      },
      lineTension: 1,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            padding: 25,
            fontColor: '#EEE5E9'
          }
        }],
        xAxes: [{
            ticks: {
                fontColor: '#EEE5E9'
            }
        }]
      }
    }
  }
  
  export default dollaChart;