export const dollaChart = {
    type: 'line',
    data: {
      labels: ['1st quarter ', '2nd quarter ', '3rd quarter ', '4th quarter'],
      datasets: [
        { // one line graph
          label: 'Predicted revenue',
          data: [21, 33, 42, 47],
          backgroundColor: [
            'transparent'
          ],
          borderColor: [
            '#A7A7FF',
          ],
          borderWidth: 3
        },
        { // another line graph
          label: 'Actual revenue',
          data: [20, 15, 40, 39],
          backgroundColor: [
            'transparent', 
          ],
          borderColor: [
            '#47b784',
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