/**
 * Utility to generate a clean, SEO-friendly slug from a product object or string.
 */
export const getProductSlug = (product: any): string => {
  if (!product) return ''
  if (typeof product === 'string') {
    return product
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9]+/g, '-')
      .replace(/^-+|-+$/g, '')
  }
  if (product.slug && typeof product.slug === 'string') {
    return product.slug
  }
  if (product.name && typeof product.name === 'string') {
    return product.name
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9]+/g, '-')
      .replace(/^-+|-+$/g, '')
  }
  return String(product.id || '')
}

