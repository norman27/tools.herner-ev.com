import * as React from 'react';
import { Fade } from 'react-slideshow-image';

const fadeProperties = {
    duration: 10000,
    transitionDuration: 500
}

type Props = {
    images: string[],
    duration: number
}

class Images extends React.Component<Props> {
    render() {
        fadeProperties.duration = this.props.duration * 1000;

        return (
          <section className="screen-images present slide-container" data-fullscreen="">
              <Fade {...fadeProperties}>
                  {this.props.images.map((image: string, index) => {
                      return (
                        <div key={index} className="each-fade">
                            <div className="image-container">
                                <img src={`/media/screen/${image}`} />
                            </div>
                        </div>
                      )
                  })}
              </Fade>
          </section>
        )
    }
}

export { Images }