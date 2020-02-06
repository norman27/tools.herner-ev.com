import * as React from 'react';

type TeamLogoProps = {
  logo: string,
  alt: string,
  width: number,
  height: number,
}

function TeamLogo(props: TeamLogoProps) {
  return (
    <img
      src={ `/bundles/hockey-teams/img/${ props.logo }` }
      alt={ props.alt }
      width={ props.width }
      height={ props.height }
    />
  )
}

export { TeamLogo }