/**
 * Browser-side Image Compressor for Universal Paints Admin Panel
 * - Resizes images to max dimensions (1920px) while maintaining aspect ratio
 * - Compresses to WebP (quality 82%) to drastically reduce upload size and page load times
 * - Preserves transparent PNG backgrounds in WebP
 * - Bypasses SVG and GIF files safely
 */
export async function compressImage(
  file: File,
  options: {
    maxWidth?: number
    maxHeight?: number
    quality?: number
    mimeType?: string
  } = {}
): Promise<File> {
  // If not an image or is SVG / GIF, return as-is
  if (!file.type.startsWith('image/') || file.type === 'image/svg+xml' || file.type === 'image/gif') {
    return file
  }

  const maxWidth = options.maxWidth || 1920
  const maxHeight = options.maxHeight || 1920
  const quality = options.quality !== undefined ? options.quality : 0.82
  const outputType = options.mimeType || 'image/webp'

  return new Promise((resolve) => {
    const reader = new FileReader()
    reader.onload = (e) => {
      const img = new Image()
      img.onload = () => {
        let width = img.width
        let height = img.height

        // Calculate proportionate dimensions
        if (width > maxWidth || height > maxHeight) {
          const ratio = Math.min(maxWidth / width, maxHeight / height)
          width = Math.round(width * ratio)
          height = Math.round(height * ratio)
        }

        const canvas = document.createElement('canvas')
        canvas.width = width
        canvas.height = height
        const ctx = canvas.getContext('2d')

        if (!ctx) {
          resolve(file)
          return
        }

        ctx.imageSmoothingEnabled = true
        ctx.imageSmoothingQuality = 'high'
        ctx.drawImage(img, 0, 0, width, height)

        canvas.toBlob(
          (blob) => {
            if (!blob) {
              resolve(file)
              return
            }

            // Use compressed blob if it's smaller or resized
            if (blob.size < file.size || width !== img.width || height !== img.height) {
              const baseName = file.name.replace(/\.[^/.]+$/, '')
              const extension = outputType === 'image/webp' ? '.webp' : (outputType === 'image/jpeg' ? '.jpg' : '.png')
              const compressedFile = new File([blob], `${baseName}${extension}`, {
                type: outputType,
                lastModified: Date.now()
              })
              resolve(compressedFile)
            } else {
              resolve(file)
            }
          },
          outputType,
          quality
        )
      }

      img.onerror = () => resolve(file)
      img.src = e.target?.result as string
    }

    reader.onerror = () => resolve(file)
    reader.readAsDataURL(file)
  })
}

