function getDataUriFromImg (url, callback) {
  let image = new Image()
  image.onload = function() {
    let canvas = document.createElement('canvas')
    canvas.width = this.naturalWidth
    canvas.height = this.naturalHeight
    canvas.getContext('2d').drawImage(this, 0, 0)
    callback(canvas.toDataURL('image/jpg'), this.naturalHeight / this.naturalWidth)
  }
  image.src = url
}

function getRootUrl() {
  let url = window.location.href
  if (url.split('.').indexOf('impactpreview') > -1) return 'vvi.impactpreview.com'
  else return 'vonberg.com'
}

function downloadCatalog() {
  if (document.getElementById('load-box')) return null // prevent accidental double clicks
  beginLoading()
  let logo, oldLogo, coverImage
  let categoryImages = {}
  getDataUriFromImg('/img/vonberg_logo.png', dataUri => {logo = dataUri})
  getDataUriFromImg('/img/1971-logo.png', dataUri => {oldLogo = dataUri})
  getDataUriFromImg('/img/MG_8080-6-75x4.png', dataUri => {coverImage = dataUri})
  getDataUriFromImg('/img/Category-PhotosFlow-Regulating-Valves.png', dataUri => {categoryImages['FLOW REGULATING VALVES'] = dataUri})
  getDataUriFromImg('/img/Category-PhotosDirectional-Valves.png', dataUri => {categoryImages['DIRECTIONAL VALVES'] = dataUri})
  getDataUriFromImg('/img/Category-PhotosSafety-Valves.png', dataUri => {categoryImages['SAFETY VALVES'] = dataUri})
  getDataUriFromImg('/img/Category-PhotosPressure-Controls.png', dataUri => {categoryImages['PRESSURE CONTROLS'] = dataUri})
  getDataUriFromImg('/img/Category-PhotosCartiridge-Bodies.png', dataUri => {categoryImages['CARTRIDGE BODIES'] = dataUri})

  let ajax = new XMLHttpRequest()
  ajax.open('GET', '/api-products')
  ajax.responseType = 'document'
  ajax.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let response = ajax.response.getElementById('response')
      console.log('response', response)

      let parts = []
      let imageCatalog = {}
      let rawParts = response.querySelectorAll('.part')
      rawParts.forEach(part => {
        let obj = {}
        obj.id = part.querySelector('.id').innerText
        obj.type = part.querySelector('.type').innerText.trim()
        obj.category = part.querySelector('.category').innerText.toUpperCase()
        obj.style = part.querySelector('.style').innerText.trim()
        obj.series = part.querySelector('.series').innerText.trim()
        obj.connection = part.querySelector('.connection').innerText
        obj.description = part.querySelector('.description').innerText.toUpperCase().replace(/˚/g, '\u00B0').replace(/\n/g, ' ')
        obj.lastUpdated = part.querySelector('.last-updated').innerText
        obj.operations = Array.from(part.querySelectorAll('.operations div')).map(op => (op.innerText.replace(/˚/g, '\u00B0')))
        obj.features = Array.from(part.querySelectorAll('.features div')).map(feat => (feat.innerText.replace(/˚/g, '\u00B0')))

        obj.specifications = Array.from(part.querySelectorAll('.specifications div .name')).map(specName => ({name: specName.innerText}))
        part.querySelectorAll('.specifications div .value').forEach((specValue, index) => {
          obj.specifications[index].value = specValue.innerText
        })
        // obj.specifications = obj.specifications.filter

        let table = []
        table.push(Array.from(part.querySelectorAll('.table .header div')).map(header => (header.innerText)))
        let colCount = table[0].length
        let rows = Array.from(part.querySelectorAll('.table .row')).map(row => (row.innerText.replace(/˚/g, '\u00B0').trim()))
        for (let i = 0; i < rows.length; i += colCount) {
          table.push(rows.slice(i, i + colCount))
        }
        obj.table = table

        parts.push(obj)
        imageCatalog[obj.id] = {ratio: {}}
      })

      // It's dumb that I have to do this but filtering out repeats...
      let idCheck = {}
      parts = parts.filter(part => {
        if (!idCheck[part.id]) {
          idCheck[part.id] = true
          return true
        } else {
          return false
        }
      })

      // Sort parts
      let categories = [
        'FLOW REGULATING VALVES',
        'DIRECTIONAL VALVES',
        'SAFETY VALVES',
        'PRESSURE CONTROLS',
        'CARTRIDGE BODIES'
      ]
      parts.sort((a, b) => {
        if (categories.indexOf(a.category) < categories.indexOf(b.category)) return -1
        if (categories.indexOf(a.category) > categories.indexOf(b.category)) return 1
        else if (a.type < b.type) return -1
        else if (a.type > b.type) return 1
        else if (a.series < b.series) return -1
        else if (a.series > b.series) return 1
        else return 0
      })

      Object.keys(imageCatalog).forEach(key => {
        getDataUriFromImg(`/img/parts/${key}/ordering_information.jpg`, (dataUri, ratio) => {
          imageCatalog[key].ordering = dataUri
          imageCatalog[key].ratio.ordering = ratio
        })
        getDataUriFromImg(`/img/parts/${key}/typical_performance.jpg`, (dataUri, ratio) => {
          imageCatalog[key].performance = dataUri
          imageCatalog[key].ratio.performance = ratio
        })
        getDataUriFromImg(`/img/parts/${key}/product_image.jpg`, (dataUri, ratio) => {
          imageCatalog[key].product = dataUri
          imageCatalog[key].ratio.product = ratio
        })
        getDataUriFromImg(`/img/parts/${key}/schematic_drawing.jpg`, (dataUri, ratio) => {
          imageCatalog[key].schematic = dataUri
          imageCatalog[key].ratio.schematic = ratio
        })
      })

      
      
      // despite promises seeming to work, pdfkit was just repeating one image
      // I need images as a data uri and not an array buffer
      // so I'm trying something darker
      // god have mercy on my soul...
      setTimeout(keepGoing, 15000)
      function keepGoing() {

        // collecting images via promises
        // Promise.all(
        //   parts.map(part => fetch(`/img/parts/${part.id}/performance_graphs.pdf`))
        // ).then(res => {
        //   parts.forEach((part, index) => {
        //     part.graphs = (res[index].status !== 404) ? true : false
        //   })

        //   return Promise.all(
        //     parts.map(part => fetch(`/img/parts/${part.id}/ordering_information.jpg`))
        //   )
        // }).then(res => {
        //   return Promise.all(res.map(part => {
        //     if (part.status === 404) return null
        //     else return part.arrayBuffer()
        //   }))
        // }).then(res => {
        //   parts.forEach((part, index) => {
        //     part.ordering = res[index]
        //   })
        //   return Promise.all(
        //     parts.map(part => fetch(`/img/parts/${part.id}/typical_performance.jpg`))
        //   )
        // }).then(res => {
        //   return Promise.all(res.map(part => {
        //     if (part.status === 404) return null
        //     else return part.arrayBuffer()
        //   }))
        // }).then(res => {
        //   parts.forEach((part, index) => {
        //     part.performance = res[index]
        //   })
        //   return Promise.all(
        //     parts.map(part => fetch(`/img/parts/${part.id}/product_image.jpg`))
        //   )
        // }).then(res => {
        //   return Promise.all(res.map(part => {
        //     if (part.status === 404) return null
        //     else return part.arrayBuffer()
        //   }))
        // }).then(res => {
        //   parts.forEach((part, index) => {
        //     part.product = res[index]
        //   })
        //   return Promise.all(
        //     parts.map(part => fetch(`/img/parts/${part.id}/schematic_drawing.jpg`))
        //   )
        // }).then(res => {
        //   return Promise.all(res.map(part => {
        //     if (part.status === 404) return null
        //     else return part.arrayBuffer()
        //   }))
        // }).then(res => {
        //   parts.forEach((part, index) => {
        //     part.schematic = res[index]
        //   })

          // now that we have images, proceed
          let queue = []
          categories.forEach(category => {
            queue = [...queue, {title: category, coverImage: categoryImages[category]}, ...parts.filter(part => (part.category == category))]
          })
          console.log('queue', queue)

          let doc = new PDFDocument({autoFirstPage: false})
          stream = doc.pipe(blobStream())
          doc.info.Title = 'Catalog'
          doc.info.Author = 'Vonberg Valve, inc.'

          const docWidth = 612
          const docHeight = 792
          let colWidth = (docWidth - 30) * .4 - 15
          let inverseWidth = (docWidth - 30) * .6 - 15
          let currentPage = 0
          let totalPages = queue.length + 1

          function wrangleImages(index) {
            let images = Object.keys(doc._imageRegistry).map(key => (doc._imageRegistry[key]))
            if (index) return index == -1 ? images[images.length - 1] : images[index]
            else return images
          }
          function getImageHeight(image, width) {
            let ratio = image.height / image.width
            return Math.ceil(ratio * width)
          }
          function getLineCount(str, width) {
            let words = str.split(' ')
            let lineStart = 0
            let lineEnd = 1
            let lineCount = 0
            while (lineStart < words.length) {
              if (doc.widthOfString(words.slice(lineStart, lineEnd + 1).join(' ')) > width || lineEnd >= words.length) {
                lineCount++
                lineStart = lineEnd
              }
              lineEnd++
            }
            return lineCount
          }

          function header(part) {
            doc.image(logo, 10, 10, {
              height: 60
            })
            if (!part.title) {
              doc.fillColor('#00703c')
              doc.font('Helvetica-Bold')
              doc.fontSize(16)
              let typeSplit = part.type.split(' ')
              if (typeSplit.length > 4) {
                doc.text(typeSplit.slice(0, 4).join(' '), 0, 28, {
                  align: 'center'
                })  
                doc.text(typeSplit.slice(4).join(' '), 0, 43, { 
                  align: 'center'
                })
              } else {
                doc.text(part.type, 0, 35, {
                  align: 'center'
                })
              }
              // default line height for 12px font is 14.4, rounding up to 15
              doc.fontSize(12)
              doc.text(part.category, 0, 15, {
                align: 'right'
              })
              doc.text(part.style, 0, 30, {
                align: 'right'
              })
              doc.fillColor('#000000')
              doc.fontSize(10)
              doc.text(part.series, 0, 45, {
                align: 'right'
              })
              doc.text(part.connection, 0, 60, {
                align: 'right'
              })
            }
            doc.rect(15, 75, docWidth - 30, 2).fillAndStroke('#00703c')
          }

          function footer(part) {
            doc.fillColor('#000000')
            doc.fontSize(6)
            doc.font('Helvetica')
            if (!part.title) {
              doc.text(
                "This document, as well as all catalogs, price lists and information provided by Vonberg Valve, Inc., is intended to provide product information for further consideration by users having substantial technical expertise due to the variety of operating conditions and applications for these valves, the user, through its own analysis, testing and evaluation, is solely responsible for making the final selection of the products and ensuring that all safety, warning and performance requirements of the application or use are met. The valves described herein, including without limitation, all component features, specifications, designs, pricing and availability, are subject to change at any time at the sole discretion of Vonberg Valve, Inc. without prior notification.",
                15, docHeight - 75
              )
              doc.fillColor('#00703c')
              doc.fontSize(8)
              doc.text(
                part.lastUpdated,
                15, docHeight - 52, {width: docWidth - 30, align: 'right'}
              )
            }
            doc.rect(15, docHeight - 43, docWidth - 30, 2).fillAndStroke('#00703c')
            if (oldLogo) doc.image(oldLogo, 15, docHeight - 40, {fit: [172, 30]})
            doc.fillColor('#000000')
            doc.text(
              '3800 Industrial Avengue • Rolling Meadows, IL 60008-1085 USA © 2015',
              colWidth + 45, docHeight - 35
            )
            doc.text(
              'phone: 847-259-3800 • fax: 847-259-3997 • email: info@vonberg.com',
              colWidth + 45, docHeight - 25
            )
            doc.fontSize(12)
            doc.text(
              // total pages won't work because we are dynamically adding pages throughout
              // `${currentPage} / ${totalPages}`,
              currentPage,
              15, docHeight - 30, {width: docWidth - 30, align: 'right'}
            )
          }

          // title page
          doc.addPage({margin: 15})
          currentPage++
          doc.rect(15, 75, docWidth - 30, 2).fillAndStroke('#00703c')
          doc.image(logo, 15, 92, {
            height: 100
          })
          doc.font('Helvetica-Bold')
          doc.fontSize(56)
          doc.text('PRODUCT', 30, 276)
          doc.text('CATALOG', 30, 336)
          doc.image(coverImage, colWidth + 45, 496, {
            width: inverseWidth
          })
          footer({title: true})

          queue.forEach((part, index) => {
            // console.log(index)
            doc.addPage({margin: 15})
            currentPage++
            header(part)

            if (part.title) {
              // category page
              doc.font('Helvetica-Bold')
              doc.fontSize(40)
              let title = part.title.split(' ')
              doc.text(title.slice(0, 2).join(' '), 30, 276)
              if (title.length > 2) doc.text(title.slice(2).join(' '), 30, 316)
              doc.image(part.coverImage, colWidth + 45, 496, {
                width: inverseWidth
              })
            } else {
              // part page
              doc.font('Helvetica-Bold')
              doc.fontSize(9)
              

              // column 1
              let leftBase = 90
              if (imageCatalog[part.id].product) {
                doc.fillColor('#000000')
                doc.text('PRODUCT', 15, leftBase) // 15 is x coord, 90 is y
                doc.rect(15, leftBase + 10, colWidth, 1).fillAndStroke('#00703c')
                doc.image(imageCatalog[part.id].product, 15, leftBase + 20, {
                  width: colWidth
                })
                // leftBase += 30 + getImageHeight(wrangleImages(-1), colWidth)
                leftBase += 30 + Math.ceil(imageCatalog[part.id].ratio.product * colWidth)
              }

              if (imageCatalog[part.id].schematic) {
                doc.fillColor('#000000')
                doc.text('SCHEMATIC', 15, leftBase)
                doc.rect(15, leftBase + 10, colWidth, 1).fillAndStroke('#00703c')
                doc.image(imageCatalog[part.id].schematic, 15, leftBase + 20, {
                  width: colWidth
                })
                // leftBase += 30 + getImageHeight(wrangleImages(-1), colWidth)
                leftBase += 30 + Math.ceil(imageCatalog[part.id].ratio.schematic * colWidth)
              }

              if (imageCatalog[part.id].performance) {
                doc.fillColor('#000000')
                doc.text('TYPICAL PERFORMANCE', 15, leftBase)
                doc.rect(15, leftBase + 10, colWidth, 1).fillAndStroke('#00703c')
                doc.image(imageCatalog[part.id].performance, 15, leftBase + 20, {
                  width: colWidth
                })
                // leftBase += 20 + getImageHeight(wrangleImages(-1), colWidth)
                leftBase += 20 + Math.ceil(imageCatalog[part.id].ratio.performance * colWidth)
                if (part.graphs) {
                  doc.text('Download Performance Curve Graphics', 15, leftBase + 6, {
                    link: `${getRootUrl()}/img/parts/${part.id}/peformance_graphs.pdf`, align: 'center', width: colWidth
                  })
                  leftBase += 12
                }
              }


              // column 2
              let extra = 0
              doc.fillColor('#000000')
              doc.text('DESCRIPTION', colWidth + 45, 90)
              doc.rect(colWidth + 45, 100, inverseWidth, 1).fillAndStroke('#00703c')
              doc.fillColor('#000000')
              doc.font('Helvetica')
              doc.text(part.description, colWidth + 45, 105)
              // extra += 12 * Math.ceil(doc.widthOfString(part.description) / inverseWidth)
              extra += 12 * getLineCount(part.description, inverseWidth)
              extra -= 10
              let bulletTime = doc.widthOfString('• ')

              if (part.operations.length > 0) {
                doc.font('Helvetica-Bold')
                doc.text('OPERATION', colWidth + 45, 120 + extra)
                doc.rect(colWidth + 45, 130 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                doc.fillColor('#000000')
                doc.font('Helvetica')
                part.operations.forEach(op => {
                  doc.text('• ', colWidth + 45, 135 + extra)                        
                  doc.text(op, colWidth + 45 + bulletTime, 135 + extra)
                  extra += 12 * Math.ceil(doc.widthOfString(op) / (inverseWidth - bulletTime))
                })
                extra -= 10
              }

              if (part.features.length > 0) {
                doc.font('Helvetica-Bold')
                doc.text('FEATURES', colWidth + 45, 150 + extra)
                doc.rect(colWidth + 45, 160 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                doc.fillColor('#000000')
                doc.font('Helvetica')
                part.features.forEach(feat => {
                  doc.text('• ', colWidth + 45, 165 + extra)
                  doc.text(feat, colWidth + 45 + bulletTime, 165 + extra)
                  extra += 12 * Math.ceil(doc.widthOfString(feat) / (inverseWidth - bulletTime))
                })
                extra -= 10
              }

              if (part.specifications.length > 0) {
                doc.font('Helvetica-Bold')
                doc.text('SPECIFICATIONS', colWidth + 45, 180 + extra)
                doc.rect(colWidth + 45, 190 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                doc.font('Helvetica')
                part.specifications.forEach(spec => {
                  doc.fillColor('#000000')
                  doc.text(spec.name, colWidth + 45, 195 + extra)
                  doc.text(spec.value, 0, 195 + extra, {align: 'right'})
                  doc.rect(colWidth + 45, 205 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                  extra += 15
                })
              }
              
              if (imageCatalog[part.id].ordering) {
                doc.font('Helvetica-Bold')
                doc.fillColor('#000000')
                doc.text('ORDERING INFORMATION', colWidth + 45, 210 + extra)
                doc.rect(colWidth + 45, 220 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                doc.image(imageCatalog[part.id].ordering, colWidth + 45, 230 + extra, {
                  width: colWidth
                })
                // extra += getImageHeight(wrangleImages(-1), colWidth)
                extra +=  Math.ceil(imageCatalog[part.id].ratio.ordering * colWidth)
              }

              let theBottom = (leftBase > 230 + extra) ? leftBase : 230 + extra
              doc.rect(colWidth + 30, 90, 2, theBottom - 90).fillAndStroke('#00703c')
              let availableSpace = (docHeight - 75) - (theBottom)
              let maxRows = Math.floor((availableSpace - 8) / 15)


              // bottom column
              let base = theBottom + 10
              let totalCol = part.table[0].length
              let tableColWidth = Math.floor((docWidth - 30) / totalCol)
              let cellWidths = {cols: totalCol}
              part.table.forEach(function(row) {
                row.forEach(function(cell, index) {
                  if (!cellWidths[index]) cellWidths[index] = 1
                  if (cell.length > cellWidths[index]) cellWidths[index] = cell.length
                })
              })
              cellWidths.total = 0
              for (let i = 0; i < cellWidths.cols; i++) {
                cellWidths.total += cellWidths[i]
              }
              let widthRef = []
              for (let i = 0; i < cellWidths.cols; i++) {
                widthRef.push(Math.floor((docWidth - 30) * (cellWidths[i] / cellWidths.total)))
              }
              function quickSum(arr) {
                let total = 0
                if (arr) arr.forEach(function(n) {total += n})
                return total
              }

              if (part.table.length > maxRows) {
                totalPages++
                footer(part)
                // console.log("ALERT! NEW PAGE")
                doc.addPage({
                  margin: 15
                })
                currentPage++
                header(part)
                base = 90
              } else if (part.table[0].length > 1) {
                doc.rect(15, base, docWidth - 30, 2).fillAndStroke('#00703c')
                base += 8
              }

              if (part.table[0].length > 1) {
                if (part.table[0].length > 8) doc.fontSize(8)
                part.table.forEach(function(row, yIndex) {
                  doc.fillColor('#000000')
                  if (yIndex === 0) doc.font('Helvetica-Bold')
                  row.forEach(function(cell, xIndex) {
                    // let match = /\r|\n/.exec(cell)
                    // if(match) {
                    //   console.log("Cell value: ", cell)
                    //   let updated = cell.replace(/\r|\n/g, ' ')
                    //   doc.text(updated, 15 + quickSum(widthRef.slice(0, xIndex)), base)
                    // } else {
                      doc.text(cell, 15 + quickSum(widthRef.slice(0, xIndex)), base)
                    // }
                  })
                  doc.rect(15, base + 10, docWidth - 30, 1).fillAndStroke('#00703c')
                  base += 15
                  if (yIndex === 0) doc.font('Helvetica')
                })
              }
            }

            footer(part)
          })

          doc.end()
          stream.on('finish', () => {
            blob = stream.toBlob('application/pdf')
            let a = document.createElement('a')
            let url = URL.createObjectURL(blob)
            a.href = url
            a.download = 'VONBERG-Product_Catalog.pdf'
            document.body.appendChild(a)
            a.click()
            setTimeout(() => {
              document.body.removeChild(a)
              window.URL.revokeObjectURL(url)
            }, 3000)
            endLoading()
          })
        // })
      }
    }
  }
  ajax.send()
}

function beginLoading() {
  let loadBox = document.createElement('div')
  loadBox.id = 'load-box'
  let gif = document.createElement('img')
  gif.src = "/img/loading.gif"
  loadBox.appendChild(gif)
  let txtHead = document.createElement('div')
  txtHead.className = 'load-head'
  txtHead.innerText = 'ONE MOMENT PLEASE'
  loadBox.appendChild(txtHead)
  let txtBody = document.createElement('div')
  txtBody.className = 'load-body'
  txtBody.innerText = "We're compiling all our products into a pdf."
  loadBox.appendChild(txtBody)
  document.querySelector('body').appendChild(loadBox)
}

function endLoading() {
  document.getElementById('load-box').remove()
}