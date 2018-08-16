Array.prototype.forEach.call(document.querySelectorAll('.form-nav'), function(btn) {
  btn.onclick = function() {
      let from = this.id.split('-')[0]
      let to = this.id.split('-')[1]
      document.getElementById(from).hidden = true
      document.getElementById(to).hidden = false
  }.bind(btn)
})
document.getElementById('generate').onclick = function() {
  // let ajax = new XMLHttpRequest()
  // ajax.open('GET', 'https://vvi.impactpreview.com/img/vonberg_logo.png')
  // ajax.responseType = 'arraybuffer'
  // ajax.onreadstatechange = function() {
  //     if (this.readState == 4 && this.status == 200) {
  //         console.log('begin write pdf')
  //         let logo = ajax.response

          let type = 'type'.toUpperCase()
          let category = 'category'
          let style = 'style'.toUpperCase() // inline or cartridge
          let series = 'series'.toUpperCase()
          let shortDescription = 'short description'.toUpperCase()
          let description = 'long description'.toUpperCase()
          let operation = ['place dat shit', 'plug dat shit', 'aww yeah, look at it go'].map(bullet => bullet.toUpperCase())
          let features = ['is a pretty cool guy', "doesn't afraid of anything"].map(bullet => bullet.toUpperCase())
          let specifications = ['this is gonna be an array of either arrays or objects, decide later'].map(bullet => bullet.toUpperCase())

          let doc = new PDFDocument({autoFirstPage: false})
          stream = doc.pipe(blobStream())
          doc.addPage({
              margin: 15
          })
          doc.info.Title = type
          doc.info.Author = 'Vonberg Valve, inc.'

          // console.log(doc)
          const docWidth = 612
          const docHeight = 792
          
          // doc.image(logo, 10, 10, {
          //     height: 60
          // })
          
          doc.fillColor('#00703c')
          doc.font('Helvetica-Bold')
          doc.fontSize(16)
          doc.text(type, 0, 35, {
              align: 'center'
          })

          // default line height for 12px font is 14.4, rounding up to 15
          doc.fontSize(12)
          doc.text(category, 0, 15, {
              align: 'right'
          })
          doc.text(style, 0, 30, {
              align: 'right'
          })
          doc.fillColor('#000000')
          doc.fontSize(10)
          doc.text(series, 0, 45, {
              align: 'right'
          })
          doc.text(shortDescription, 0, 60, {
              align: 'right'
          })

          doc.rect(15, 75, docWidth - 30, 2).fillAndStroke('#00703c')
          
          let colWidth = (docWidth - 30) / 2 - 15
          // colWidth = (docWidth - 30) / 3 - 15

          doc.rect(colWidth + 30, 90, 2, 500).fillAndStroke('#00703c')


          // column 1

          doc.fillColor('#000000')
          doc.text('PRODUCT', 15, 90)
          doc.rect(15, 100, colWidth, 1).fillAndStroke('#00703c')
          // product image
          // doc.image(path.resolve(__dirname, './pdf-imgs/schematic_drawing.jpg'), 15, 110, {
          //     fit: [colWidth, colWidth]
          // })

          doc.fillColor('#000000')
          doc.text('SCHEMATIC', 15, 90 + colWidth)
          doc.rect(15, 100 + colWidth, colWidth, 1).fillAndStroke('#00703c')
          // schematic image

          doc.fillColor('#000000')
          doc.text('TYPICAL PERFORMANCE', 15, 90 + colWidth + 100)
          doc.rect(15, 100 + colWidth + 100, colWidth, 1).fillAndStroke('#00703c')
          // performance image

          // column 2
          let extra = 0

          doc.fillColor('#000000')
          doc.text('DESCRIPTION', colWidth + 45, 90)
          doc.rect(colWidth + 45, 100, colWidth, 1).fillAndStroke('#00703c')
          doc.fillColor('#000000')
          doc.font('Helvetica')
          doc.text(description, colWidth + 45, 105)
          // extra += 15

          doc.font('Helvetica-Bold')
          doc.text('OPERATION', colWidth + 45, 120 + extra)
          doc.rect(colWidth + 45, 130 + extra, colWidth, 1).fillAndStroke('#00703c')
          doc.fillColor('#000000')
          doc.font('Helvetica')
          operation.forEach((op, index) => {
              doc.text('• ' + op, colWidth + 45, 135 + extra)
              extra += 15
          })
          extra -= 15

          doc.font('Helvetica-Bold')
          doc.text('FEATURES', colWidth + 45, 150 + extra)
          doc.rect(colWidth + 45, 160 + extra, colWidth, 1).fillAndStroke('#00703c')
          doc.fillColor('#000000')
          doc.font('Helvetica')
          features.forEach((feat, index) => {
              doc.text('• ' + feat, colWidth + 45, 165 + extra)
              extra += 15
          })
          extra -= 15

          doc.font('Helvetica-Bold')
          doc.text('SPECIFICATIONS', colWidth + 45, 180 + extra)
          doc.rect(colWidth + 45, 190 + extra, colWidth, 1).fillAndStroke('#00703c')
          doc.fillColor('#000000')
          doc.font('Helvetica')
          specifications.forEach((spec, index) => {
              doc.text('• ' + spec, colWidth + 45, 195 + extra)
              extra += 15
          })
          // extra -= 15

          doc.font('Helvetica-Bold')
          doc.text('ORDERING INFORMATION', colWidth + 45, 210 + extra)
          doc.rect(colWidth + 45, 220 + extra, colWidth, 1).fillAndStroke('#00703c')
          //  ordering info image

          // bottom column


          doc.fillColor('#000000')
          doc.fontSize(6)
          doc.text(
              "This document, as well as all catalogs, price lists and information provided by Vonberg Valve, Inc., is intended to provide product information for further consideration by users having substantial technical expertise due to the variety of operating conditions and applications for these valves, the user, through its own analysis, testing and evaluation, is solely responsible for making the final selection of the products and ensuring that all safety, warning and performance requirements of the application or use are met. The valves described herein, including without limitation, all component features, specifications, designs, pricing and availability, are subject to change at any time at the sole discretion of Vonberg Valve, Inc. without prior notification.",
              15, docHeight - 90
          )

          // footer
          doc.rect(15, docHeight - 55, docWidth - 30, 2).fillAndStroke('#00703c')

          // doc.fontSize(18)
          // doc.text(
          //   'Vonberg Valve, inc.',
          //   15, docHeight - 45
          // )

          doc.fillColor('#000000')
          doc.fontSize(8)
          doc.text(
              '3800 Industrial Avengue • Rolling Meadows, IL 60008-1085 USA © 2015',
              0, docHeight - 45, {align: 'center'}
          )
          doc.text(
              'phone: 847-259-3800 • fax: 847-259-3997 • email: info@vonberg.com',
              0, docHeight - 30, {align: 'center'}
          )

          doc.end()
          stream.on('finish', () => {
              console.log('end write pdf')
              blob = stream.toBlob('application/pdf')
              let a = document.createElement('a')
              let url = URL.createObjectURL(blob)
              a.href = url
              a.download = 'nameme.pdf'
              document.body.appendChild(a)
              a.click()
              setTimeout(() => {
                  document.body.removeChild(a)
                  window.URL.revokeObjectURL(url)
              }, 0)
          })
  //     } else {
  //         console.log('ajax request failed')
  //     }
  // }
  // ajax.send()
}