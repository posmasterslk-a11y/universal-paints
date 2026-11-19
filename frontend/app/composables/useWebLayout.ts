import { computed } from 'vue'

export const useWebLayout = () => {
  const config = useRuntimeConfig()
  const cleanApiBase = computed(() => {
    return (config.public.apiBase || 'https://api.universalpaints.lk').replace(/\/api\/?$/, '')
  })

  // Fetch subpages layout configuration with SSR cache
  const { data: subpagesLayout } = useFetch(
    () => `${cleanApiBase.value}/api/web-layout/subpages`,
    { key: 'subpages-web-layout' }
  )

  const resolveImageUrl = (path?: string | null): string => {
    if (!path) return ''
    if (path.startsWith('http://') || path.startsWith('https://')) return path
    if (path.startsWith('/images/')) return path
    return `${cleanApiBase.value}${path}`
  }

  const getSubpageHeader = (pageKey: string, fallbackImage: string = ''): string => {
    const headers = subpagesLayout.value?.subpage_headers || {}
    const pageData = headers[pageKey]
    const customImg = pageData?.image
    if (customImg && typeof customImg === 'string' && customImg.trim() !== '') {
      return resolveImageUrl(customImg.trim())
    }
    return fallbackImage
  }

  return {
    subpagesLayout,
    getSubpageHeader,
    resolveImageUrl
  }
}
